<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class BookingConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Booking $booking)
    {
        $this->booking->loadMissing('slot.variant.tour');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking confirmed — ' . $this->booking->reference,
        );
    }

    public function content(): Content
    {
        // Signed cancel link, expires in 7 days (adjust if you want shorter)
        $cancelUrl = URL::temporarySignedRoute(
            'bookings.cancel.request',
            now()->addDays(7),
            ['reference' => $this->booking->reference]
        );

        return new Content(
            view: 'emails.bookings.confirmed-html',
            text: 'emails.bookings.confirmed-text',
            with: [
                'booking' => $this->booking,
                'cancelUrl' => $cancelUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
