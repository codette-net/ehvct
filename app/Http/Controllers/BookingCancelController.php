<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;


class BookingCancelController extends Controller
{
    private const CANCEL_LINK_TTL_MINUTES = 30;

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


    public function submit(Request $request, string $reference)
    {
        $booking = $this->findBookingOrFail($reference);

        $data = $request->validate([
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        $cutoff = $this->cancellationCutoffFor($booking);
        $canCancel = now()->lt($cutoff);

        // MVP: send email to admin; no auto-cancel for now.
        $adminEmail = $this->adminNotifyEmail();
        if (!$adminEmail) {
            return redirect()
                ->route('bookings.cancel.request', $booking->reference)
                ->with('status', 'Cancellation request could not be sent right now. Please try again later.');
        }

        Mail::raw(
            $this->buildAdminCancellationBody($booking, $canCancel, $data['message'] ?? null),
            fn($m) => $m->to($adminEmail)->subject("Cancellation request — {$booking->reference}")
        );

        return redirect()
            ->to($this->signedCancelRequestUrl($booking))
            ->with('status', 'Cancellation request sent. We will contact you by e-mail shortly.');
    }

    private function findBookingOrFail(string $reference): Booking
    {
        $booking = Booking::where('reference', $reference)->firstOrFail();
        $booking->load('slot.variant.tour');

        return $booking;
    }

    private function cancellationCutoffFor(Booking $booking)
    {
        return $booking->slot->starts_at->copy()->subHours((int)$booking->slot->cancel_cutoff_hours);
    }

    private function canCancel(Booking $booking): bool
    {
        return now()->lt($this->cancellationCutoffFor($booking));
    }

    private function adminNotifyEmail(): ?string
    {
        return config('mail.admin_notify') ?: env('ADMIN_NOTIFY_EMAIL');
    }

    private function buildAdminCancellationBody(Booking $booking, bool $canCancel, ?string $message): string
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
