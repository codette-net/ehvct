@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-14 min-h-[66dvh]">
        <h1 class="text-3xl font-bold">Cancellation request</h1>

        @php
            $isCanceled = $booking->status === 'canceled';
            $isRefunded = $booking->status === 'refunded' || !is_null($booking->refunded_at);
            $isHandled = $isCanceled || $isRefunded;
        @endphp

        <div class="card mt-4 bg-neutral-content/60 p-4 rounded-lg shadow-lg max-w-4xl">
            <div class="card-body">
                <div class="font-semibold">
                    {{ $booking->slot->variant->tour->title }} | {{ $booking->slot->variant->label }}
                </div>
                <div class="opacity-70">{{ $booking->slot->starts_at->format('D d M Y, H:i') }}</div>
                <div class="opacity-70">
                    Reference: <span class="font-mono">{{ $booking->reference }}</span>
                </div>

                <div class="mt-4 flex flex-wrap gap-2 items-center">
                    @if($isRefunded)
                        <div class="badge badge-info p-4">Canceled and refunded</div>
                    @elseif($isCanceled)
                        <div class="badge badge-error p-4">Canceled</div>
                    @else
                        <div class="badge {{ $canCancel ? 'badge-success' : 'badge-warning' }} p-4">
                            {{ $canCancel ? 'Within cancellation window' : 'Past cancellation cutoff' }}
                        </div>
                    @endif
                </div>

                <p class="text-sm opacity-70 mt-2">
                    Cutoff time: {{ $cutoff->format('D d M Y, H:i') }}
                </p>

                @if($isRefunded)
                    <div class="alert alert-info mt-6">
                    <span>
                        Your booking has been canceled and refunded.
                        @if($booking->refunded_at)
                            Refund processed at {{ $booking->refunded_at->format('D d M Y, H:i') }}.
                        @endif
                    </span>
                    </div>
                @elseif($isCanceled)
                    <div class="alert alert-success mt-6">
                        <span>Your booking has been canceled.</span>
                    </div>
                @else
                    <div class="mt-6">
                        @if($canCancel)
                            <div class="alert alert-info mb-4">
                            <span>
                                You are still within the cancellation window. Submitting this form will process your cancellation automatically.
                            </span>
                            </div>
                        @else
                            <div class="alert alert-warning mb-4">
                            <span>
                                You are past the cancellation cutoff. You can still send a request, but it will not be processed automatically.
                            </span>
                            </div>
                        @endif

                        <form method="POST" action="{{ $cancelPostUrl ?? '' }}" class="space-y-3">
                            @csrf

                            <label class="form-control">
                                <div class="label">
                                    <span class="label-text">Message (optional)</span>
                                </div>
                                <textarea
                                    class="textarea textarea-bordered"
                                    name="message"
                                    rows="4"
                                    placeholder="Optional note about your cancellation"
                                >{{ old('message') }}</textarea>
                                @error('message')
                                <span class="text-error text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </label>

                            <button class="btn btn-primary">
                                {{ $canCancel ? 'Cancel booking' : 'Send request' }}
                            </button>
                        </form>
                    </div>
                @endif

                @if($booking->canceled_reason)
                    <div class="mt-6">
                        <h2 class="font-semibold mb-2">Cancellation note</h2>
                        <div class="rounded-lg border border-base-300 bg-base-100 p-4 text-sm">
                            {{ $booking->canceled_reason }}
                        </div>
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('tours.index') }}" class="btn btn-outline">Back to tours</a>
                </div>
            </div>
        </div>
    </section>
@endsection
