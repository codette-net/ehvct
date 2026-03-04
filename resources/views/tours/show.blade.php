@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-14">

    <div class="breadcrumbs text-sm mb-4">
        <ul>
            <li><a href="{{ route('tours.index') }}" class="underline">Tours</a></li>
            <li>{{ $tour->title }}</li>
        </ul>
    </div>

    <article class="grid md:grid-cols-3 gap-8 rj-tour bg-neutral-content/60 p-4 rounded-lg shadow-lg">
        <div class="lg:col-span-2">
            <h1 class="text-4xl font-bold">{{ $tour->title }}</h1>

            <div class="max-w-none mt-6 rj-description">
                {!! $tour->description !!}
            </div>




        </div>

        <aside class="lg:col-span-1">
            <div class="card bg-primary/75 sticky top-6">
                <div class="card-body">
                    <h3 class="card-title">Book this tour</h3>
                   <div class="mt-4 space-y-2">
                        @foreach($tour->variants as $variant)
                            <div class="flex justify-between items-center bg-base-100 rounded p-3">
                                <div>
                                    <div class="font-semibold">{{ $variant->label }}</div>
                                    <div class="text-sm opacity-70">{{ $variant->duration_minutes }} min</div>
                                </div>
                                <div class="font-semibold">
                                    €{{ number_format($variant->price_per_person_cents / 100, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 space-y-4">
                        @foreach($tour->variants as $variant)
                            <div class="bg-base-100 rounded p-3 border">
                                <div class="flex justify-between items-start gap-3">
                                    <div>
                                        <div class="font-semibold">{{ $variant->label }}</div>
                                        <div class="text-sm opacity-70">{{ $variant->duration_minutes }} min</div>
                                    </div>
                                    <div class="font-semibold">
                                        €{{ number_format($variant->price_per_person_cents / 100, 2) }}
                                    </div>
                                </div>

                                <div class="mt-3 space-y-2">
                                    @php
                                        $slots = $variant->slots->filter(fn($s) => $s->isBookableNow());
                                    @endphp

                                    @forelse($slots as $slot)
                                        <a href="{{ route('bookings.create', $slot) }}"
                                           class="btn btn-outline btn-sm w-full justify-between">
                                            <span>{{ $slot->starts_at->format('D d M, H:i') }}</span>
                                            <span class="opacity-70">Seats left: {{ $slot->remainingSeats() }}</span>
                                        </a>
                                    @empty
                                        <div class="text-sm opacity-70">No bookable slots right now.</div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </aside>
        <div class="grid md:grid-cols-3 col-span-3 gap-4">
            <div class="p-2 border border-gray-500 rounded-md bg-base-100 bg-opacity-50 shadow">
                <h3 class="text-2xl font-semibold mb-2">Highlights</h3>

                {!! $tour->highlights !!}
            </div>
            <div class="p-2 border border-gray-500 rounded-md bg-base-100 bg-opacity-50 shadow">
                <h3 class="text-2xl font-semibold">Meeting point</h3>
                <p class="mt-2">{{ $tour->meeting_point ?: 'TBD' }}</p>
            </div>
        </div>
    </article>
   <section class="max-w-6xl mx-auto px-4 py-14">

@endsection
