@extends('layouts.app')

@section('content')
    <div class="breadcrumbs text-sm mb-4">
        <ul>
            <li><a href="{{ route('tours.index') }}">Tours</a></li>
            <li>{{ $tour->title }}</li>
        </ul>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <h1 class="text-4xl font-bold">{{ $tour->title }}</h1>

            <div class="prose max-w-none mt-6">
                {!! $tour->description !!}
            </div>

            <div class="mt-8">
                <h2 class="text-2xl font-semibold">Highlights</h2>
                <div class="prose max-w-none mt-3">
                    {!! $tour->highlights !!}
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-2xl font-semibold">Meeting point</h2>
                <p class="mt-2 opacity-80">{{ $tour->meeting_point ?: 'TBD' }}</p>
            </div>
        </div>

        <aside class="lg:col-span-1">
            <div class="card bg-base-200 sticky top-6">
                <div class="card-body">
                    <h3 class="card-title">Book this tour</h3>

                    <p class="opacity-80 text-sm">
                        Next step: show upcoming slots + variant selection here.
                    </p>

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
    </div>
@endsection
