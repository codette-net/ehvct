@php
    $map = [
        'pending' => ['alert-warning', 'Payment pending… waiting for confirmation.'],
        'confirmed' => ['alert-success', 'Payment confirmed! Your booking is confirmed.'],
        'canceled' => ['alert-error', 'Payment canceled. No booking was confirmed.'],
        'failed' => ['alert-error', 'Payment failed. Please try again.'],
        'expired' => ['alert-error', 'Payment expired. Please try again.'],
        'refunded' => ['alert-warning', 'Payment refunded']
    ];
    [$cls, $msg] = $map[$status] ?? $map['pending'];
@endphp

<div class="alert {{ $cls }}">
    <span>{{ $msg }}</span>
</div>
