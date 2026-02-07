@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold">{{ $tour->title }}</h1>
            @if($tour->meeting_point)
                <p class="text-slate-600 mt-1">Meeting point: {{ $tour->meeting_point }}</p>
            @endif
        </div>

        @if($tour->coverImage()->exists())
            @php $cover = $tour->coverImage()->first(); @endphp
            <img class="w-full max-h-[420px] object-cover rounded"
                 src="{{ asset('storage/'.$cover->file_path) }}"
                 alt="{{ $cover->alt }}">
        @endif

        @if($tour->description)
            <div class="prose max-w-none">
                {!! nl2br(e($tour->description)) !!}
            </div>
        @endif

        <div>
            <h2 class="text-xl font-semibold mb-3">Durations & prices</h2>
            <div class="grid gap-3 md:grid-cols-2">
                @foreach($tour->variants as $variant)
                    <div class="rounded border p-4">
                        <div class="font-medium">{{ $variant->label }}</div>
                        <div class="text-sm text-slate-600">
                            €{{ $variant->price_per_person }} per person
                            @if($variant->duration_minutes) · {{ $variant->duration_minutes }} min @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded border p-4 bg-slate-50">
            <div class="font-medium">Booking calendar (placeholder)</div>
            <p class="text-sm text-slate-600 mt-1">
                Next step: show upcoming slots per variant + reserve seats + Stripe Checkout.
            </p>
        </div>

        @php $gallery = $tour->galleryImages()->get(); @endphp
        @if($gallery->count())
            <div>
                <h2 class="text-xl font-semibold mb-3">Gallery</h2>
                <div class="grid gap-3 grid-cols-2 md:grid-cols-4">
                    @foreach($gallery as $img)
                        <img class="aspect-square object-cover rounded"
                             src="{{ asset('storage/'.$img->file_path) }}"
                             alt="{{ $img->alt }}">
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
