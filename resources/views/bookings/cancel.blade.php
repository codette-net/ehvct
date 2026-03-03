@extends('layouts.app')

@section('content')
    <div class="max-w-2xl">
        <h1 class="text-3xl font-bold">Cancellation request</h1>

        @if(session('status'))
            <div class="alert alert-success mt-4"><span>{{ session('status') }}</span></div>
        @endif

        <div class="card bg-base-200 mt-6">
            <div class="card-body">
                <div class="font-semibold">{{ $booking->slot->variant->tour->title }} — {{ $booking->slot->variant->label }}</div>
                <div class="opacity-70">{{ $booking->slot->starts_at->format('D d M Y, H:i') }}</div>
                <div class="opacity-70">Reference: <span class="font-mono">{{ $booking->reference }}</span></div>

                <div class="mt-4">
                    <div class="badge {{ $canCancel ? 'badge-success' : 'badge-warning' }}">
                        {{ $canCancel ? 'Within cancellation window' : 'Past cancellation cutoff' }}
                    </div>
                    <p class="text-sm opacity-70 mt-2">
                        Cutoff time: {{ $cutoff->format('D d M Y, H:i') }}
                    </p>
                </div>

                <form method="POST" action="{{ route('bookings.cancel.submit', $booking->reference) }}" class="mt-6 space-y-3">
                    @csrf
                    <label class="form-control">
                        <div class="label"><span class="label-text">Message (optional)</span></div>
                        <textarea class="textarea textarea-bordered" name="message" rows="4"></textarea>
                    </label>

                    <button class="btn btn-primary">Send request</button>
                </form>
            </div>
        </div>
    </div>
@endsection
