Booking canceled

Hi {{ $booking->name }},

Your booking has been canceled.

Reference: {{ $booking->reference }}
Tour: {{ $booking->slot->variant->tour->title }} — {{ $booking->slot->variant->label }}
Date/time: {{ $booking->slot->starts_at->format('D d M Y, H:i') }}

Reason:
{{ $booking->canceled_reason ?? '-' }}

If you have questions, reply to this email.

{{ config('app.name') }}
