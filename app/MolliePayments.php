<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use Mollie\Api\MollieApiClient;

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

        $molliePayment = $this->mollie->payments->create([
            'amount' => [
                'currency' => $booking->currency,
                'value' => number_format($booking->total_amount_cents / 100, 2, '.', ''),
            ],
            'description' => "Eindhoven Cycling Tours — {$booking->reference}",
            'redirectUrl' => route('payment.success', ['reference' => $booking->reference]),
            'webhookUrl' => route('webhooks.mollie'),
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
        if (! $bookingId) return;

        $booking = Booking::find($bookingId);
        if (! $booking) return;

        $payment = $booking->payment;
        if ($payment) {
            $payment->update([
                'provider_status' => $molliePayment->status,
                'webhook_payload' => $molliePayment->jsonSerialize(),
                'paid_at' => $molliePayment->isPaid() ? now() : $payment->paid_at,
            ]);
        }

        if ($molliePayment->isPaid()) {
            $booking->update([
                'status' => 'confirmed',
                'paid_at' => $booking->paid_at ?? now(),
                'confirmed_at' => $booking->confirmed_at ?? now(),
            ]);
        } elseif ($molliePayment->isCanceled() || $molliePayment->isExpired() || $molliePayment->isFailed()) {
            $booking->update([
                'status' => $molliePayment->isCanceled() ? 'canceled' : ($molliePayment->isExpired() ? 'expired' : 'failed'),
            ]);
        }
    }
}
