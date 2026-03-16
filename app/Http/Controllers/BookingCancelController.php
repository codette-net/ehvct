<?php

namespace App\Http\Controllers;

use App\Mail\BookingCanceledMail;
use App\Models\Booking;
use App\Services\MolliePayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class BookingCancelController extends Controller
{
    private const CANCEL_LINK_TTL_MINUTES = 10;

    public function request(string $reference): \Illuminate\View\View
    {
        $booking = $this->findBookingOrFail($reference);

        $now = now();
        $cutoff = $this->cancellationCutoffFor($booking);
        $canCancel = $this->canCancel($booking);

        $cancelPostUrl = URL::temporarySignedRoute(
            'bookings.cancel.submit',
            $now->copy()->addMinutes(self::CANCEL_LINK_TTL_MINUTES),
            ['reference' => $booking->reference]
        );

        return view('bookings.cancel', compact('booking', 'cutoff', 'canCancel', 'cancelPostUrl'));
    }

    public function submit(Request $request, string $reference, MolliePayments $molliePayments)
    {
        $booking = $this->findBookingOrFail($reference);

        $data = $request->validate([
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        // Already handled
        if (in_array($booking->status, ['canceled', 'refunded'], true)) {
            return redirect()
                ->to($this->signedCancelRequestUrl($booking))
                ->with('status', 'This booking has already been canceled.');
        }

        $canCancel = $this->canCancel($booking);

        if ($canCancel) {
            try {
                // Store customer message as cancellation reason if provided
                if (! empty($data['message'])) {
                    $booking->update([
                        'canceled_reason' => $data['message'],
                    ]);
                }

                // Auto cancel/refund through Mollie
                $result = $molliePayments->cancelOrRefundBooking($booking);

                $booking->refresh();

                // Customer email
                try {
                    Mail::to($booking->email)->send(new BookingCanceledMail($booking));
                } catch (\Throwable $mailException) {
                    Log::error('Customer cancellation email failed', [
                        'booking_id' => $booking->id,
                        'reference' => $booking->reference,
                        'error' => $mailException->getMessage(),
                    ]);
                }

                // Optional admin FYI email
                $adminEmail = $this->adminNotifyEmail();
                if ($adminEmail) {
                    try {
                        Mail::raw(
                            $this->buildAdminCancellationBody(
                                $booking,
                                true,
                                $data['message'] ?? null,
                                $result
                            ),
                            fn ($m) => $m->to($adminEmail)->subject("Customer cancellation processed — {$booking->reference}")
                        );
                    } catch (\Throwable $mailException) {
                        Log::error('Admin cancellation notification failed', [
                            'booking_id' => $booking->id,
                            'reference' => $booking->reference,
                            'error' => $mailException->getMessage(),
                        ]);
                    }
                }

                return redirect()
                    ->to($this->signedCancelRequestUrl($booking))
                    ->with(
                        'success',
                        $result === 'refunded'
                            ? 'Your booking has been canceled and refunded.'
                            : 'Your booking has been canceled.'
                    );
            } catch (\Throwable $e) {
                Log::error('Customer auto-cancel/refund failed', [
                    'booking_id' => $booking->id,
                    'reference' => $booking->reference,
                    'error' => $e->getMessage(),
                ]);

                return redirect()
                    ->to($this->signedCancelRequestUrl($booking))
                    ->with('error', 'We could not process your cancellation automatically right now. Please contact us.');
            }
        }

        // Past cutoff: notify admin only
        $adminEmail = $this->adminNotifyEmail();

        if (! $adminEmail) {
            return redirect()
                ->to($this->signedCancelRequestUrl($booking))
                ->with('Error', 'Cancellation request could not be sent right now. Please try again later.');
        }

        try {
            Mail::raw(
                $this->buildAdminCancellationBody(
                    $booking,
                    false,
                    $data['message'] ?? null,
                    'request_only'
                ),
                fn ($m) => $m->to($adminEmail)->subject("Cancellation request — {$booking->reference}")
            );

            return redirect()
                ->to($this->signedCancelRequestUrl($booking))
                ->with('status', 'Your cancellation request has been sent. We will contact you by e-mail shortly.');
        } catch (\Throwable $e) {
            Log::error('Admin cancellation request email failed', [
                'booking_id' => $booking->id,
                'reference' => $booking->reference,
                'error' => $e->getMessage(),
            ]);

            return redirect()
                ->to($this->signedCancelRequestUrl($booking))
                ->with('error', 'Cancellation request could not be sent right now. Please try again later.');
        }
    }

    private function findBookingOrFail(string $reference): Booking
    {
        $booking = Booking::where('reference', $reference)->firstOrFail();
        $booking->load('slot.variant.tour', 'payment');

        return $booking;
    }

    private function cancellationCutoffFor(Booking $booking)
    {
        return $booking->slot->starts_at->copy()->subHours((int) $booking->slot->cancel_cutoff_hours);
    }

    private function canCancel(Booking $booking): bool
    {
        return now()->lt($this->cancellationCutoffFor($booking));
    }

    private function adminNotifyEmail(): ?string
    {
        return config('mail.admin_notify') ?: env('ADMIN_NOTIFY_EMAIL');
    }

    private function buildAdminCancellationBody(Booking $booking, bool $canCancel, ?string $message, string $result): string
    {
        $messageText = ($message !== null && $message !== '') ? $message : '-';

        return implode("\n", [
            'Cancellation request',
            '',
            "Ref: {$booking->reference}",
            "Name: {$booking->name}",
            "Email: {$booking->email}",
            "Tour: {$booking->slot->variant->tour->title}",
            "When: {$booking->slot->starts_at}",
            'Can cancel (policy): ' . ($canCancel ? 'yes' : 'no'),
            "Result: {$result}",
            '',
            'Message:',
            $messageText,
        ]);
    }

    private function signedCancelRequestUrl(Booking $booking): string
    {
        return URL::temporarySignedRoute(
            'bookings.cancel.request',
            now()->addMinutes(self::CANCEL_LINK_TTL_MINUTES),
            ['reference' => $booking->reference]
        );
    }
}
