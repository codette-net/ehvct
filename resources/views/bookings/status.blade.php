@extends('layouts.app')

@section('content')
    @php
        $tour = $booking->slot->variant->tour;
        $variant = $booking->slot->variant;

        $stepDetails = 'step-primary';
        $stepPayment = in_array($booking->status, ['pending','confirmed']) ? 'step-primary' : '';
        $stepConfirm = $booking->status === 'confirmed' ? 'step-primary' : '';
    @endphp
    <section class="max-w-6xl mx-auto px-4 py-20">

        <div class="breadcrumbs text-sm mb-4">
            <ul>
                <li><a href="{{ route('tours.index') }}">Tours</a></li>
                <li><a href="{{ route('tours.show', $tour) }}">{{ $tour->title }}</a></li>
                <li>Booking status {{ $booking->reference  }}</li>
            </ul>
        </div>

        <h1 class="text-3xl font-bold">Booking status</h1>

        <div class="mt-4 bg-neutral-content/60 p-4 rounded-lg shadow-lg max-w-4xl">
            <div class="card-body">
                <div class="grid grid-cols-2 flex-none gap-8 bg-neutral-content/60 p-4 items-end justify-center border-gray-500 rounded-md shadow-sm ">
                    <div class="flex flex-col flex-none gap-2 border-r pr-4">
                        <div class="font-semibold">{{ $tour->title }} — {{ $variant->label }}</div>
                        <div class="text-sm opacity-70">{{ $booking->slot->starts_at->format('D d M Y, H:i') }}</div>
                        <div class="text-sm opacity-70">Reference: <span class="font-mono">{{ $booking->reference }}</span></div>
                    </div>
                    <p class="text-center flex-none">
                        <span class="font-semibold text-lg">
                            >€{{ number_format($booking->total_amount_cents / 100, 2) }}
                        </span> <span class="text-sm opacity-70">{{ $booking->people_count }} person(s)</span>
                    </p>
                </div>
                <div class="steps steps-vertical md:steps-horizontal mt-4">
                    <div class="step {{ $stepDetails }}">Details</div>
                    <div class="step {{ $stepPayment }}">Payment</div>
                    <div class="step {{ $stepConfirm }}">Confirmation</div>
                </div>

                @if(session('error'))
                    <div class="alert alert-error mt-4">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                <div id="statusBox" class="mt-6">
                    @include('bookings.partials.status-box', ['status' => $booking->status])
                </div>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('tours.index') }}" class="btn btn-primary">Back to tours</a>

                    @if($booking->status === 'confirmed')
                        <a href="{{ URL::temporarySignedRoute('bookings.cancel.request', now()->addDays(7), ['reference' => $booking->reference]) }}"
                           class="btn btn-outline">
                            Request cancellation
                        </a>
                    @endif
                </div>

                <p class="text-xs opacity-70 mt-4">
                    If your payment is pending, this page will update automatically.
                </p>
            </div>
        </div>
    </section>
    <script>
        (function () {
            const reference = @json($booking->reference);
            const url = @json(route('bookings.status.json', ['reference' => $booking->reference]));
            const statusBox = document.getElementById('statusBox');

            let tries = 0;
            const maxTries = 30; // ~30 * 2s = 60 seconds
            const intervalMs = 2000;

            function render(status) {

                if (status === 'confirmed') {
                    window.location.reload();
                    return;
                }

                const map = {
                    pending: { cls: 'alert-warning', msg: 'Payment pending… waiting for confirmation.' },
                    canceled: { cls: 'alert-error', msg: 'Payment canceled. No booking was confirmed.' },
                    failed: { cls: 'alert-error', msg: 'Payment failed. Please try again.' },
                    expired: { cls: 'alert-error', msg: 'Payment expired. Please try again.' },
                };

                const v = map[status] || map.pending;
                statusBox.innerHTML = `<div class="alert ${v.cls}"><span>${v.msg}</span></div>`;
            }

            async function tick() {
                tries++;
                if (tries > maxTries) return;

                try {
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                    const data = await res.json();
                    render(data.status);

                    if (data.status !== 'pending') return;
                } catch (e) {
                    // ignore
                }

                setTimeout(tick, intervalMs);
            }

            // Only poll if pending
            if (@json($booking->status) === 'pending') {
                setTimeout(tick, intervalMs);
            }
        })();
    </script>
@endsection
