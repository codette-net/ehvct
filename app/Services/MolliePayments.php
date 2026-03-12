<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use Mollie\Api\MollieApiClient;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmedMail;
use App\Mail\AdminBookingConfirmedMail;

class MolliePayments
{
    public function __construct(private readonly MollieApiClient $mollie)
    {
        $this->mollie->setApiKey(config('services.mollie.key'));
    }

    public function createPaymentForBooking(Booking $booking): string
    {
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'provider' => 'mollie',
            'amount_cents' => $booking->total_amount_cents,
            'currency' => $booking->currency,
            'provider_status' => 'open',
        ]);

        \Log::info('Creating Mollie payment', [
            'amount' => [
                'currency' => $booking->currency,
                'value' => number_format($booking->total_amount_cents / 100, 2, '.', ''),
            ],
            'description' => "Eindhoven Cycling Tours — {$booking->reference}",
            'redirectUrl' => route('bookings.status', ['reference' => $booking->reference]),
            'webhookUrl' => config('services.mollie.webhook_url'),
            'metadata' => [
                'booking_id' => $booking->id,
                'reference' => $booking->reference,
            ],
        ]);

        $molliePayment = $this->mollie->payments->create([
            'amount' => [
                'currency' => $booking->currency,
                'value' => number_format($booking->total_amount_cents / 100, 2, '.', ''),
            ],
            'description' => "Eindhoven Cycling Tours — {$booking->reference}",
            'redirectUrl' => route('bookings.status', ['reference' => $booking->reference]),
//            'webhookUrl' => route('webhooks.mollie'),
            'webhookUrl' => config('services.mollie.webhook_url'),
            'metadata' => [
                'booking_id' => $booking->id,
                'reference' => $booking->reference,
            ],
        ]);

        $payment->update([
            'provider_payment_id' => $molliePayment->id,
            'provider_status' => $molliePayment->status,
        ]);

        return $molliePayment->getCheckoutUrl();
    }

    public function handleWebhook(string $providerPaymentId): void
    {
        $molliePayment = $this->mollie->payments->get($providerPaymentId);

        $bookingId = $molliePayment->metadata->booking_id ?? null;
        if (!$bookingId) return;

        $booking = Booking::find($bookingId);
        if (!$booking) return;

        \Log::info('Mollie webhook received', [
            'provider_payment_id' => $providerPaymentId,
            'mollie_status' => $molliePayment->status,
            'booking_id' => $bookingId,
        ]);

        $payment = $booking->payment;
        if ($payment) {
            $payment->update([
                'provider_status' => $molliePayment->status,
                'webhook_payload' => json_decode(json_encode($molliePayment), true),
                'paid_at' => $molliePayment->isPaid() ? now() : $payment->paid_at,
            ]);
        }

        if ($molliePayment->isPaid()) {
            $wasConfirmed = in_array($booking->status, ['confirmed', 'paid'], true);

            $booking->update([
                'status' => 'confirmed',
                'paid_at' => $booking->paid_at ?? now(),
                'confirmed_at' => $booking->confirmed_at ?? now(),
            ]);

            if (!$wasConfirmed) {
                Mail::to($booking->email)->send(new BookingConfirmedMail($booking));

                $admin = config('mail.admin_notify') ?? env('ADMIN_NOTIFY_EMAIL');
                if ($admin) {
                    Mail::to($admin)->send(new AdminBookingConfirmedMail($booking));
                }
            }
        } elseif ($molliePayment->isCanceled() || $molliePayment->isExpired() || $molliePayment->isFailed()) {
            $booking->update([
                'status' => $molliePayment->isCanceled() ? 'canceled' : ($molliePayment->isExpired() ? 'expired' : 'failed'),
            ]);
        }
    }

    public function cancelPaymentForBooking(Booking $booking): void
    {
        $payment = $booking->payment;

        if (! $payment || ! $payment->provider_payment_id) {
            throw new \RuntimeException('Payment not found or not yet processed.');
        }

        $molliePayment = $this->mollie->payments->get($payment->provider_payment_id);

        if (! $molliePayment->isCancelable) {
            throw new \RuntimeException('This payment is no longer cancelable.');
        }

        $this->mollie->payments->cancel($payment->provider_payment_id);

        $payment->update([
            'provider_status' => 'canceled',
        ]);

        $booking->update([
            'status' => 'canceled',
            'canceled_at' => now(),
        ]);

        \Log::info('Mollie payment canceled', [
            'booking_id' => $booking->id,
            'reference' => $booking->reference,
            'provider_payment_id' => $payment->provider_payment_id,
        ]);
    }

    public function refundPaymentForBooking(Booking $booking, ?int $amountCents = null): void
    {
        $payment = $booking->payment;

        if (! $payment || ! $payment->provider_payment_id) {
            throw new \RuntimeException('Payment not found or not yet processed.');
        }

        $refundAmount = $amountCents ?? $booking->total_amount_cents;

        if ($refundAmount <= 0) {
            throw new \RuntimeException('Refund amount must be greater than zero.');
        }

        $this->mollie->paymentRefunds->createForId(
            $payment->provider_payment_id,
            [
                'amount' => [
                    'currency' => $booking->currency,
                    'value' => number_format($refundAmount / 100, 2, '.', ''),
                ],
            ]
        );

        $payment->update([
            'provider_status' => 'refunded',
        ]);

        $booking->update([
            'status' => 'refunded',
            'canceled_at' => $booking->canceled_at ?? now(),
        ]);

        \Log::info('Mollie refund created', [
            'booking_id' => $booking->id,
            'reference' => $booking->reference,
            'provider_payment_id' => $payment->provider_payment_id,
            'refund_amount_cents' => $refundAmount,
        ]);
    }

}
