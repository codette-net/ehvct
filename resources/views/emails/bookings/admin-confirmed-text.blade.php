Booking confirmed for  {{ $booking->name }},

Reference: {{ $booking->reference }}
Tour: {{ $booking->slot->variant->tour->title }} — {{ $booking->slot->variant->label }}
Date/time: {{ $booking->slot->starts_at->format('D d M Y, H:i') }}
People: {{ $booking->people_count }}
Total paid: €{{ number_format($booking->total_amount_cents / 100, 2) }}

{{ config('app.name') }}
