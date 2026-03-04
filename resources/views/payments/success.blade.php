@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-14 min-h-[66dvh]">
        <h1 class="text-3xl font-bold">Thanks! 🎉</h1>

        <div class="mt-4 card mt-4 bg-neutral-content/60 p-4 rounded-lg shadow-lg max-w-3xl">
            <div class="card-body">
                <p class="opacity-80">
                    Your booking reference:
                    <span class="font-mono font-semibold">{{ $booking->reference }}</span>
                </p>

                <div class="mt-4">
                    <div class="badge {{ $booking->status === 'confirmed' ? 'badge-success' : 'badge-warning' }} p-4">
                        Status: {{ $booking->status }}
                    </div>
                </div>

                <p class="mt-4">
                    If your status is still “pending”, the payment webhook may still be processing.
                    Refresh in a few seconds or click <a href="" class="underline" id="refreshPage">here</a>
                </p>

                <div class="mt-6">
                    <a href="{{ route('tours.index') }}" class="btn btn-outline">Back to tours</a>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('refreshPage').addEventListener('click', function(event) {
            event.preventDefault();
            location.reload();
        });
    </script>
@endsection
