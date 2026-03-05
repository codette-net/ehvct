@php
    $tour = $booking->slot->variant->tour;
    $variant = $booking->slot->variant;
@endphp
    <!doctype html>
<html><body style="font-family:Arial,Helvetica,sans-serif;color:#111;">
<h2>Booking canceled</h2>
<p>Hi {{ $booking->name }},</p>
<p>Your booking has been canceled.</p>

<p><strong>Reference:</strong> {{ $booking->reference }}<br>
    <strong>Tour:</strong> {{ $tour->title }} — {{ $variant->label }}<br>
    <strong>Date/time:</strong> {{ $booking->slot->starts_at->format('D d M Y, H:i') }}</p>

<p><strong>Reason:</strong><br>
    {{ $booking->canceled_reason ?? '-' }}</p>

<p>If you have questions, reply to this email.</p>
<p><strong>{{ config('app.name') }}</strong></p>
</body></html>
