@component('mail::message')
    # New booking

    **Reference:** {{ $booking->reference }}

    **Customer:** {{ $booking->name }} ({{ $booking->email }})
    **Phone:** {{ $booking->phone ?? '-' }}

    **Tour:** {{ $booking->slot->variant->tour->title }} — {{ $booking->slot->variant->label }}
    **Date/time:** {{ $booking->slot->starts_at->format('D d M Y, H:i') }}
    **People:** {{ $booking->people_count }}
    **Total:** €{{ number_format($booking->total_amount_cents / 100, 2) }}

@endcomponent
