<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
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
        return new Envelope(
            subject: 'Booking canceled — ' . $this->booking->reference,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bookings.canceled-html',
            text: 'emails.bookings.canceled-text',
            with: ['booking' => $this->booking],
        );
    }
}
