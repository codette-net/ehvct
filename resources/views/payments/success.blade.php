@extends('layouts.app')

@section('content')
    <div class="max-w-2xl">
        <h1 class="text-3xl font-bold">Thanks! 🎉</h1>

        <div class="mt-4 card bg-base-200">
            <div class="card-body">
                <p class="opacity-80">
                    Your booking reference:
                    <span class="font-mono font-semibold">{{ $booking->reference }}</span>
                </p>

                <div class="mt-4">
                    <div class="badge {{ $booking->status === 'confirmed' ? 'badge-success' : 'badge-warning' }}">
                        Status: {{ $booking->status }}
                    </div>
                </div>

                <p class="mt-4 text-sm opacity-70">
                    If your status is still “pending”, the payment webhook may still be processing.
                    Refresh in a few seconds.
                </p>

                <div class="mt-6">
                    <a href="{{ route('tours.index') }}" class="btn btn-outline">Back to tours</a>
                </div>
            </div>
        </div>
    </div>
@endsection
