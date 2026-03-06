@extends('layouts.app')

@section('content')
    {{-- HERO --}}
    <section class="hero min-h-[85vh]"
             style="background-image: url(/images/EHVCT-cover-img.jpg); background-position: 33% 50%;">
        <div class="hero-overlay bg-neutral/60"></div>
        <div class="hero-content flex-col gap-10 text-neutral-content z-10">
            <img src="/images/ehvct_logo.png"
                 class="w-60 sm:w-72 rounded-lg shadow-2xl bg-white/70 p-4" alt="EHVCT logo"/>

            <div class="max-w-xl">
                <h1 class="text-4xl sm:text-5xl font-bold leading-tight">
                    Easy rides. Great stories. Better views
                </h1>
                <p class="py-6 text-lg opacity-95">
                    Relaxed group rides through Brabant countryside. Perfect for expats and locals.
                </p>

                <div class="flex flex-wrap gap-3">
                    <a class="btn btn-accent" href="{{ route('tours.index') }}">Book a tour</a>
                    <a class="btn btn-accent" href="{{ route('tours.index') }}">See all tours</a>
                </div>

                <div class="mt-6 flex flex-wrap gap-3 text-sm opacity-95">
                    <span class="badge badge-primary">Local guide</span>
                    <span class="badge badge-primary">Beginner-friendly</span>
                    <span class="badge badge-primary">Expats & locals</span>
                    <span class="badge badge-primary">Small groups</span>
                </div>
            </div>
        </div>
    </section>


    {{-- HIGHLIGHTS --}}
    {{--    <div class="mask-container">--}}

    <div class="mask-box">

        {{-- FEATURED TOURS --}}
        <section class="max-w-5xl mx-auto px-4 pb-14 above-mask-box">
            <div class="flex items-end justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-3xl font-bold">Popular tours</h2>
                    <p class="opacity-80 mt-1">Pick a ride, choose a date, and you’re set.</p>
                </div>
                <a class="btn btn-outline" href="{{ route('tours.index') }}">All tours</a>
            </div>

            <div class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-y-20 gap-x-8 mt-10 mb-5">
                @forelse($tours as $tour)
                    <article class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                        <h3 class="text-lg font-bold text-black truncate block capitalize py-2 px-4">{{ $tour->title }}</h3>

                        <a href="{{ route('tours.show', $tour) }}" title="{{ $tour->title }}">
                            @if($tour->cover_url)
                                <figure class="aspect-[16/10] h-80 w-72 object-cover rounded-t-xl">
                                    <img src="{{ $tour->cover_url }}"
                                         alt="{{ $tour->cover_media?->alt_text ?? $tour->title }}"
                                         class="w-full h-full object-cover">
                                </figure>
                            @else
                                <div class="aspect-[16/10] bg-base-200 flex items-center justify-center opacity-70">
                                    No image yet
                                </div>
                            @endif
                            {{--                    <img src="{{ $tour  }}" alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />--}}
                            <div class="px-4 py-3 w-72">
                                {{--                        <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>--}}
                                @if($tour->next_slot_at)
                                    <p class="text-sm badge badge-outline badge-neutral">
                                        Next
                                        available: {{ \Illuminate\Support\Carbon::parse($tour->next_slot_at)->format('D d M, H:i') }}
                                    </p>
                                @endif
                                <div class="flex items-center">
                                    {{--                            todo get 'from price'--}}
                                    {{--                            <p class="text-lg font-semibold text-black cursor-auto my-3">&euro;20</p>--}}
                                    @if($tour->starting_from_cents !== null)
                                        <div class="cursor-auto my-3 ml-2 flex flex-col">
                                            <div class="text-sm opacity-70">Starting from</div>
                                            <div class="text-lg font-semibold">{{ $tour->starting_from_formatted }}</div>
                                        </div>
                                    @endif
                                    {{--                            <del>--}}
                                    {{--                                <p class="text-sm text-gray-600 cursor-auto ml-2">$199</p>--}}
                                    {{--                            </del>--}}
                                    <div class="card-actions justify-end mt-2 ml-auto">
                                        <span class="btn btn-accent btn-md">View</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    <p>No tours yet.</p>
                @endforelse
            </div>

        </section>

    </div>

    {{--    </div>--}}


    {{-- HOW BOOKING WORKS --}}
    <section class="bg-base-100/60 mx-auto px-4 py-14 z-10">
        <div class="max-w-6xl grid md:grid-cols-4 sm:grid-cols-2 gap-6">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Local guide</h2>
                    <p class="text-sm opacity-80">Maurice was born and raised in Eindhoven.</p>
                </div>
                <figure>
                    <img
                        src="/images/ehvct_logo.png"
                        alt="Shoes"/>
                </figure>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Relaxed pace</h2>
                    <p class="text-sm opacity-80">Not a race. Just a good ride together.</p>
                </div>
                <figure>
                    <img
                        src="/images/EHVCT-bike-sunset.jpg"
                        alt="Bike with sun setting in the background"/>
                </figure>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Great stops</h2>
                    <p class="text-sm opacity-80">Coffee, views, and local favorites along the way.</p>
                </div>
                <figure>
                    <img
                        src="/images/EHVCT-mill-oerle.jpg"
                        alt="View of the Mill Oerle"/>
                </figure>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Meet people</h2>
                    <p class="text-sm opacity-80">A friendly mix of expats and locals.</p>
                </div>
                <figure>
                    <img
                        src="/images/EHVCT-people-cartoon.jpg"
                        alt="people on the border of the Netherlands and Belgium"/>
                </figure>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-4 py-14">
            <h2 class="text-3xl font-bold mb-8">Booking is simple</h2>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-2xl font-bold">1</div>
                        <h3 class="font-semibold">Choose a tour</h3>
                        <p class="text-sm opacity-80">Pick your route and vibe.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-2xl font-bold">2</div>
                        <h3 class="font-semibold">Select a date & group size</h3>
                        <p class="text-sm opacity-80">See available spots instantly.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-2xl font-bold">3</div>
                        <h3 class="font-semibold">Pay online</h3>
                        <p class="text-sm opacity-80">You’ll receive a confirmation email right away.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}

    <section class="max-w-6xl mx-auto px-4 py-14">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-3xl font-bold mb-4">Meet your guide</h2>
                <div class="avatar" style="float: left; margin-right: 1.5rem; shape-outside: circle();">
                    <div class="ring-accent ring-offset-base-100 w-24 rounded-full ring-2 ring-offset-2">
                        <img src="/images/EHVCT_Maurice_avatar.jpg"/>
                    </div>
                </div>
                <p class="mt-4 opacity-85">
                    Eindhoven Cycling Tours was founded by Maurice Meijer, born and raised in Eindhoven.
                    Today ECT brings people together on easy-going rides through nature, villages, and hidden
                    highlights.
                </p>
                <div class="mt-6 flex gap-3">
                    <a class="btn btn-outline" href="#">Read more</a>
                    <a class="btn btn-accent" href="{{ route('tours.index') }}">Book a tour</a>
                </div>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h3 class="font-semibold">Also available</h3>
                    <p class="text-sm opacity-80">Private tours, company outings, and teambuilding rides.</p>
                    <a class="btn btn-outline" href="{{ route('contact.show') }}">Request a private tour</a>
                </div>
            </div>
        </div>
    </section>

    {{-- FINAL CTA --}}
    <section class="bg-accent text-accent-content">
        <div class="max-w-6xl mx-auto px-4 py-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold">Ready to ride?</h2>
                <p class="opacity-90 mt-1">Choose a tour and grab your spot.</p>
            </div>
            <div class="flex gap-3">
                <a class="btn btn-neutral" href="{{ route('tours.index') }}">Book a tour</a>
                <a class="btn btn-outline border-accent-content text-accent-content" href="{{ route('contact.show') }}">Ask
                    a question</a>
            </div>
        </div>
    </section>
    {{-- FAQ --}}
    <section class="bg-base-200">
        <div class="max-w-4xl mx-auto px-4 py-14">
            <h2 class="text-3xl font-bold mb-8 text-center">Frequently asked questions</h2>

            <div class="space-y-3">

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion" checked="checked"/>
                    <div class="collapse-title font-semibold">
                        Do I need to bring my own bike?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        You can bring your own bike or rent one nearby. We can recommend local rental partners in
                        Eindhoven.
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion"/>
                    <div class="collapse-title font-semibold">
                        How difficult are the tours?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        The rides are relaxed and beginner-friendly. We keep a comfortable pace and take regular breaks.
                        You do not need to be sporty to join.
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion"/>
                    <div class="collapse-title font-semibold">
                        What happens if the weather is bad?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        Light rain is usually fine. If conditions are unsafe we reschedule or refund the tour.
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion"/>
                    <div class="collapse-title font-semibold">
                        Can I cancel my booking?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        You can cancel up to the allowed cutoff time before the tour. After that the booking is final
                        because the spot has been reserved.
                    </div>
                </div>

                <div class="collapse collapse-arrow bg-base-100 border border-base-300">
                    <input type="radio" name="faq-accordion"/>
                    <div class="collapse-title font-semibold">
                        Is the tour in English or Dutch?
                    </div>
                    <div class="collapse-content text-sm opacity-80">
                        Both. Maurice speaks English and Dutch, so everyone can follow along comfortably.
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
