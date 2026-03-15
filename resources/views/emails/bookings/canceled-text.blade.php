@if($isRefunded)
    Booking canceled and refunded
@else
    Booking canceled
@endif

Hi {{ $booking->name }},

@if($isRefunded)
    Your booking has been canceled and your payment has been refunded.
@else
    Your booking has been canceled.
@endif

Reference: {{ $booking->reference }}
Tour: {{ $booking->slot->variant->tour->title }} — {{ $booking->slot->variant->label }}
Date/time: {{ $booking->slot->starts_at->format('D d M Y, H:i') }}
People: {{ $booking->people_count }}
Total: €{{ number_format($booking->total_amount_cents / 100, 2) }}

@if($isRefunded && $booking->refunded_at)
    Refunded at: {{ $booking->refunded_at->format('D d M Y, H:i') }}
@endif

@if($booking->canceled_reason)
    Reason:
    {{ $booking->canceled_reason }}

@endif
If you have any questions, feel free to reply to this email.

{{ config('app.name') }}
