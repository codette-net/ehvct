@extends('layouts.app')
@section('title',  $tour->title)

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-20">

    <div class="breadcrumbs text-sm mb-4">
        <ul>
            <li><a href="{{ route('tours.index') }}" class="underline">Tours</a></li>
            <li>{{ $tour->title }}</li>
        </ul>
    </div>

    <article class="flex flex-wrap justify-between gap-8 rj-tour bg-neutral-content/60 p-4 rounded-lg shadow-lg">
        <div class="max-w-[44ch] md:max-w-[54ch] lg:max-w-[70ch]">
            <h1 class="text-4xl font-bold">{{ $tour->title }}</h1>
            @if($tour->cover_url)
            <figure class="aspect-[3/4] max-w-[33ch] object-cover rounded-xl mt-4 shadow-md">
                <img src="{{ $tour->cover_url }}"
                     alt="{{ $tour->cover_media?->alt_text ?? $tour->title }}"
                     class="w-full h-full object-cover rounded-xl">
            </figure>
            @else
                <hr>
            @endif
            <div class="flex flex-wrap">
                <div class="max-w-none mt-4 rj-description">
                    {!! $tour->description !!}
                </div>
                <div class="flex flex-wrap gap-4 mt-4 justify-center items-start">
                    <div class="flex-auto py-2 border border-gray-500 rounded-md bg-base-100/60 shadow-md max-w-[15rem]">
                        <h3 class="text-2xl font-semibold text-center px-2 pb-2 border-b" style="border-bottom-color: #2225">Highlights</h3>
                        <div class="px-2">
                            <p class="mt-2 text-balance px-2">
                                {!! $tour->highlights !!}
                            </p>
                        </div>

                    </div>
                    <div class="flex-auto py-2 border border-gray-500 rounded-md bg-base-100/60 shadow-md max-w-[15rem]">
                        <h3 class="text-2xl font-semibold text-center px-2 pb-2 border-b" style="border-bottom-color: #2225">Meeting point</h3>
                        <p class="mt-2 text-balance px-2">{{ $tour->meeting_point ?: 'TBD' }}</p>
                    </div>
                </div>
            </div>




        </div>

        <aside class="card bg-primary/75 sticky top-20 rounded-xl shadow-md h-full border border-current max-w-[20rem]">
                <div class="card-body">
                    <h3 class="card-title">Book this tour</h3>

                    <div class="mt-4 space-y-4">
                        @foreach($tour->variants as $variant)
                            <div class="bg-base-100 rounded-xl p-3 border border-current">
                                <div class="flex justify-between items-start gap-3">
                                    <div>
                                        <div class="font-semibold">{{ $variant->label }}</div>
                                        <div class="text-sm opacity-70">{{ number_format($variant->duration_minutes / 60 , 1)  }} hours</div>
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
                                        <span class="opacity-70">Seats left: {{ $slot->remainingSeats() }}</span>

                                        <a href="{{ route('bookings.create', $slot) }}"
                                           class="btn btn-outline btn-md w-full justify-between">
                                            <span>{{ $slot->starts_at->format('D d M, H:i') }}</span>
                                            <span class="btn btn-accent btn-xs">book</span>
                                        </a>
                                    @empty
                                        <div class="text-sm opacity-70">No bookable slots right now.</div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

        </aside>
    </article>
   <section class="max-w-6xl mx-auto px-4 py-14">

@endsection
