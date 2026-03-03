Booking confirmed

Hi {{ $booking->name }},

Your booking is confirmed.

Reference: {{ $booking->reference }}
Tour: {{ $booking->slot->variant->tour->title }} — {{ $booking->slot->variant->label }}
Date/time: {{ $booking->slot->starts_at->format('D d M Y, H:i') }}
People: {{ $booking->people_count }}
Total paid: €{{ number_format($booking->total_amount_cents / 100, 2) }}
Meeting point: {{ $booking->slot->variant->tour->meeting_point ?? 'See tour page' }}

Cancellation policy
Cancellations are only possible before the cutoff time.
Request cancellation:
{{ $cancelUrl }}

Thanks,
{{ config('app.name') }}
