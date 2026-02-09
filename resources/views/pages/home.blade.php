@extends('layouts.app')

@section('content')
    {{-- HERO --}}
    <section class="hero min-h-[85vh]"
             style="background-image: url(/images/EHVCT-cover-img.jpg); background-position: 33% 50%;">
        <div class="hero-overlay bg-neutral/60"></div>
        <div class="hero-content flex-col gap-10 text-neutral-content">
            <img src="/images/ehvct_logo.png"
                 class="w-60 sm:w-72 rounded-lg shadow-2xl bg-white/70 p-4" alt="EHVCT logo" />

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
    <section class="max-w-6xl mx-auto px-4 py-14">
        <div class="grid md:grid-cols-4 gap-6">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Local guide</h2>
                    <p class="text-sm opacity-80">Maurice was born and raised in Eindhoven.</p>
                </div>
                <figure>
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                        alt="Shoes" />
                </figure>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Relaxed pace</h2>
                    <p class="text-sm opacity-80">Not a race. Just a good ride together.</p>
                </div>
                <figure>
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                        alt="Shoes" />
                </figure>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Great stops</h2>
                    <p class="text-sm opacity-80">Coffee, views, and local favorites along the way.</p>
                </div>
                <figure>
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                        alt="Shoes" />
                </figure>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Meet people</h2>
                    <p class="text-sm opacity-80">A friendly mix of expats and locals.</p>
                </div>
                <figure>
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                        alt="Shoes" />
                </figure>
            </div>
        </div>
    </section>

    {{-- FEATURED TOURS --}}
    <section class="max-w-6xl mx-auto px-4 pb-14">
        <div class="flex items-end justify-between gap-4 mb-6">
            <div>
                <h2 class="text-3xl font-bold">Popular tours</h2>
                <p class="opacity-80 mt-1">Pick a ride, choose a date, and you’re set.</p>
            </div>
            <a class="btn btn-outline" href="{{ route('tours.index') }}">All tours</a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            {{-- Replace with @foreach later --}}
            <div class="card bg-base-100 shadow-sm">
                <figure><img src="/images/tours/forest.jpg" alt="Forest & Apple Pie Tour"></figure>
                <div class="card-body">
                    <h3 class="card-title">Forest & Apple Pie Tour</h3>
                    <p class="text-sm opacity-80">Green paths, calm roads, and a well-earned sweet stop.</p>
                    <div class="card-actions justify-between items-center mt-2">
                        <span class="badge badge-ghost">From €… p.p.</span>
                        <a class="btn btn-accent btn-sm" href="{{ route('tours.index') }}">View dates</a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-sm">
                <figure><img src="/images/tours/oirschot.jpg" alt="Strawberry Farm & Oirschot Tour"></figure>
                <div class="card-body">
                    <h3 class="card-title">Strawberry Farm & Oirschot Tour</h3>
                    <p class="text-sm opacity-80">Ride to Oirschot, fuel up at a strawberry farm, and explore the historic centre.</p>
                    <div class="card-actions justify-between items-center mt-2">
                        <span class="badge badge-ghost">From €20 p.p.</span>
                        <a class="btn btn-accent btn-sm" href="{{ route('tours.index') }}">View dates</a>
                    </div>
                </div>
            </div>

            <div class="card bg-base-100 shadow-sm">
                <figure><img src="/images/tours/sunset.jpg" alt="Sunset Tour & Van Gogh Bike Path"></figure>
                <div class="card-body">
                    <h3 class="card-title">Sunset Tour & Van Gogh Bike Path</h3>
                    <p class="text-sm opacity-80">Golden-hour ride, then the glowing Van Gogh-Roosegaarde path.</p>
                    <div class="card-actions justify-between items-center mt-2">
                        <span class="badge badge-ghost">From €12.50 p.p.</span>
                        <a class="btn btn-accent btn-sm" href="{{ route('tours.index') }}">View dates</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- HOW BOOKING WORKS --}}
    <section class="bg-base-200">
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
                        <h3 class="font-semibold">Select a date</h3>
                        <p class="text-sm opacity-80">See availability and spots instantly.</p>
                    </div>
                </div>
                <div class="card bg-base-100 shadow-sm">
                    <div class="card-body">
                        <div class="text-2xl font-bold">3</div>
                        <h3 class="font-semibold">Pay online</h3>
                        <p class="text-sm opacity-80">Receive confirmation right away.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section class="max-w-6xl mx-auto px-4 py-14">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-3xl font-bold">Meet your guide</h2>
                <p class="mt-4 opacity-85">
                    Eindhoven Cycling Tours was founded by Maurice Meijer, born and raised in Eindhoven.
                    Today ECT brings people together on easy-going rides through nature, villages, and hidden highlights.
                </p>
                <div class="mt-6 flex gap-3">
                    <a class="btn btn-outline" href="#">About Maurice</a>
                    <a class="btn btn-accent" href="{{ route('tours.index') }}">Book a tour</a>
                </div>
            </div>
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h3 class="font-semibold">Also available</h3>
                    <p class="text-sm opacity-80">Private tours, company outings, and teambuilding rides.</p>
                    <a class="btn btn-ghost justify-start px-0" href="{{ route('contact') }}">Request a private tour →</a>
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
                <a class="btn btn-outline border-accent-content text-accent-content" href="{{ route('contact') }}">Ask a question</a>
            </div>
        </div>
    </section>
@endsection
