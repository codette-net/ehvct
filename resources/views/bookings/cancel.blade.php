@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-14 min-h-[66dvh]">

    <h1 class="text-3xl font-bold">Cancellation request</h1>
        <div class="card mt-4 bg-neutral-content/60 p-4 rounded-lg shadow-lg max-w-4xl">
            <div class="card-body">
                <div class="font-semibold">{{ $booking->slot->variant->tour->title }} | {{ $booking->slot->variant->label }}</div>
                <div class="opacity-70">{{ $booking->slot->starts_at->format('D d M Y, H:i') }}</div>
                <div class="opacity-70">Reference: <span class="font-mono">{{ $booking->reference }}</span></div>

                <div class="mt-4">
                    <div class="badge {{ $canCancel ? 'badge-success' : 'badge-warning' }} p-4">
                        {{ $canCancel ? 'Within cancellation window' : 'Past cancellation cutoff' }}
                    </div>
                    <p class="text-sm opacity-70 mt-2">
                        Cutoff time: {{ $cutoff->format('D d M Y, H:i') }}
                    </p>
                </div>

                <form method="POST" action="{{ $cancelPostUrl ?? '' }}" class="mt-6 space-y-3">
                    @csrf
                    <label class="form-control">
                        <div class="label"><span class="label-text">Message (optional)</span></div>
                        <textarea class="textarea textarea-bordered" name="message" rows="4"></textarea>
                    </label>

                    <button class="btn btn-primary">Send request</button>
                </form>
            </div>
        </div>
    </section>
@endsection
