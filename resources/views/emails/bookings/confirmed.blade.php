@component('mail::message')
    # Booking confirmed

    Hi {{ $booking->name }},

    Your booking is confirmed.

    **Reference:** {{ $booking->reference }}

    **Tour:** {{ $booking->slot->variant->tour->title }} — {{ $booking->slot->variant->label }}
    **Date/time:** {{ $booking->slot->starts_at->format('D d M Y, H:i') }}
    **People:** {{ $booking->people_count }}
    **Total paid:** €{{ number_format($booking->total_amount_cents / 100, 2) }}

    **Meeting point:** {{ $booking->slot->variant->tour->meeting_point ?? 'See tour page' }}

    ---

    ## Cancellation policy
    Cancellations are only possible before the cutoff time. If you need to cancel, use the link below:

    @component('mail::button', ['url' => route('bookings.cancel.request', ['reference' => $booking->reference])])
        Request cancellation
    @endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent
