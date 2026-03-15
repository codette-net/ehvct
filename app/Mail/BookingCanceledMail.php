<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingCanceledMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Booking $booking)
    {
        $this->booking->loadMissing('slot.variant.tour');
    }

    public function envelope(): Envelope
    {
        $isRefunded = $this->booking->status === 'refunded' || ! is_null($this->booking->refunded_at);

        return new Envelope(
            subject: $isRefunded
                ? 'Booking canceled and refunded — ' . $this->booking->reference
                : 'Booking canceled — ' . $this->booking->reference,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bookings.canceled-html',
            text: 'emails.bookings.canceled-text',
            with: [
                'booking' => $this->booking,
                'isRefunded' => $this->booking->status === 'refunded' || ! is_null($this->booking->refunded_at),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
