@extends('layouts.app')
@section('title', 'About Maurice')
@section('meta_description', 'Meet Maurice, founder of Eindhoven Cycling Tours, and discover the story behind the rides.')
@section('canonical', route('about'))

@section('content')
    {{-- HERO --}}
    <section class="hero min-h-[80vh] "
             style="background-image: url(/images/EHVCT_Maurice_cover_cropped.jpg);background-position: 15% 49%;
    background-repeat: no-repeat;
">
        <div class="hero-overlay bg-neutral/60"></div>

        <div class="hero-content text-neutral-content w-full ">
            <div class="max-w-3xl text-center px-4">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Meet Maurice
                </h1>
                <p class="mt-5 text-lg md:text-xl opacity-90">
                    Born and raised in Eindhoven, guiding relaxed cycling tours that connect people with the city,
                    its countryside, and each other.
                </p>

                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('tours.index') }}" class="btn btn-accent">Book a tour</a>
                    <a href="{{ route('impressions') }}"
                       class="btn btn-outline text-neutral-content border-neutral-content">
                        See impressions
                    </a>
                    <a href="https://wa.link/uk5101" target="_blank" class="btn btn-ghost text-neutral-content">
                        Ask on WhatsApp
                    </a>
                </div>

                <div class="mt-6 flex flex-wrap justify-center gap-2 text-sm opacity-90">
                    <span class="badge badge-outline">English + Dutch</span>
                    <span class="badge badge-outline">Beginner-friendly</span>
                    <span class="badge badge-outline">Small groups</span>
                    <span class="badge badge-outline">Nature + culture</span>
                </div>
            </div>
        </div>
    </section>

    {{-- INTRO --}}
    <section class="max-w-5xl mx-auto px-4 md:px-6 py-14">
        <div class="prose max-w-none">
            <h2 class="text-3xl mb-4">What Eindhoven Cycling Tours is about</h2>
            <p class="text-lg">
                Eindhoven Cycling Tours is a relaxed, community-focused way to discover Eindhoven and its surroundings
                by bike.
                These are not rushed tourist trips or training rides. We take it easy, enjoy the route, and make good
                stops along the way.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-8">
            <div class="card bg-base-100/80 rj-shadow-inset">
                <div class="card-body">
                    <h3 class="font-semibold">Ride with a local</h3>
                    <p class="text-sm opacity-80">
                        Maurice knows the quiet paths, viewpoints, and places people often miss.
                    </p>
                </div>
            </div>
            <div class="card bg-base-100/80 rj-shadow-inset">
                <div class="card-body">
                    <h3 class="font-semibold">No stress navigation</h3>
                    <p class="text-sm opacity-80">
                        You just ride, enjoy the scenery, and follow the group.
                    </p>
                </div>
            </div>
            <div class="card bg-base-100/80 rj-shadow-inset">
                <div class="card-body">
                    <h3 class="font-semibold">Connection</h3>
                    <p class="text-sm opacity-80">
                        Locals and expats, students and visitors. Everyone is welcome.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- STORY --}}
    <section class="bg-neutral-100/60">
        <div class="max-w-5xl mx-auto px-4 md:px-6 py-14 z-10">
            <div class="grid lg:grid-cols-2 gap-10 items-start">
                <div class="prose max-w-[768px]">
                    <h2 class="text-3xl mb-4">The story</h2>
                    <p class="text-lg">
                        Maurice Meijer was born and raised in Eindhoven. After a knee injury, cycling started as a way
                        to recover.
                        A short ride became longer trips, and eventually cycling adventures all the way to Oxford and
                        Cambridge.
                    </p>
                    <p class="text-lg mt-2">
                        In 2015 he founded Eindhoven Cycling Tours to share the hidden highlights of Eindhoven and
                        Brabant by bike.
                    </p>
                </div>

                <div
                    class="relative mx-auto max-w-fit rounded-xl overflow-hidden rj-shadow-inset bg-cover bg-center p-4  "
                    style="background-image: url('{{ asset('images/bike_on_the_Wall.png') }}');"
                >
                    <!-- soft glow -->
                    <div class="absolute inset-0 bg-white/10 backdrop-blur-[1px] pointer-events-none"></div>
                    <div class="flex-1 rj-rough-glass p-8 lg:p-10 flex flex-col justify-center rounded-lg">
                        <h3 class="card-title mb-4 text-2xl">What to expect</h3>
                        <ul class="text-sm opacity-80 space-y-2">
                            <li class="badge">Relaxed pace and friendly group vibe</li>
                            <li class="badge">Nature reserves, villages, and quiet cycling paths</li>
                            <li class="badge">Stops for photos, stories, and a coffee or snack</li>
                            <li class="badge">English and Dutch tours available</li>
                        </ul>

                        <div class="mt-4">
                            <a href="{{ route('tours.index') }}" class="btn btn-accent btn-sm">Choose a tour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    {{-- FOR WHO --}}
    <section class="max-w-5xl mx-auto px-4 md:px-6 py-14">
        <div class="prose max-w-none">
            <h2 class="text-3xl mb-4">Who is it for?</h2>
            <p class="text-lg">
                Eindhoven Cycling Tours is for anyone who likes being outside and wants to explore beyond the city
                centre.
                Many riders are expats who want to feel more confident cycling in the Netherlands, but locals are just
                as welcome.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mt-8">
            <div class="card bg-base-100/80 rj-shadow-inset">
                <div class="card-body">
                    <h3 class="font-semibold">Expats</h3>
                    <p class="text-sm opacity-80">
                        Get comfortable with Dutch cycling culture in a supportive group. The pace is gentle and the
                        route is taken care of.
                    </p>
                </div>
            </div>
            <div class="card bg-base-100/80 rj-shadow-inset">
                <div class="card-body">
                    <h3 class="font-semibold">Locals & visitors</h3>
                    <p class="text-sm opacity-80">
                        Discover new routes, hidden nature areas, and the best places just outside Eindhoven.
                    </p>
                </div>
            </div>
        </div>
    </section>
    {{-- BIKE RENTAL --}}
{{--    <section class="max-w-5xl mx-auto px-4 md:px-6 pb-14">--}}
{{--        <div class="card bg-base-100 shadow-sm border border-base-200">--}}
{{--            <div class="card-body">--}}
{{--                <h3 class="card-title">Need a bike?</h3>--}}
{{--                <p class="text-sm opacity-80">--}}
{{--                    No problem. You can bring your own bike, or rent one in Eindhoven.--}}
{{--                    We often recommend our rental partner Velorent.--}}
{{--                </p>--}}

{{--                <div class="mt-4 flex flex-wrap gap-3 items-center">--}}
{{--                    <a href="https://velorent.nl/" target="_blank" class="btn btn-outline btn-sm">Velorent (bike--}}
{{--                        rental)</a>--}}
{{--                    <a href="{{ route('contact.show') }}" class="btn btn-accent btn-sm">Ask about rentals</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    {{-- PRIVATE / TEAM --}}
    <section class="bg-neutral-100/60">
        <div class="max-w-5xl mx-auto px-4 md:px-6 py-14">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <div class="prose max-w-none">
                    <h2 class="text-3xl mb-4">Private tours & team rides</h2>
                    <p class="text-lg">
                        It is also possible to book a private tour, a company outing, or a teambuilding ride.
                        We can tailor the route, pace, distance, and stops to your group.
                    </p>
                </div>

                <div class="card bg-base-100/80 shadow-lg border-[6px] border-neutral-200/90 rj-card-inset drop-shadow-lg">
                    <div class="card-body rounded bg-transparent">
                        <h3 class="card-title">Interested?</h3>
                        <p class="text-sm opacity-80">
                            Send a message and tell us your group size, preferred date, and what kind of ride you want.
                        </p>

                        <div class="flex flex-wrap gap-3 mt-4">
                            <a href="{{ route('contact.show') }}" class="btn btn-accent">Contact</a>
                            <a href="https://wa.link/uk5101" target="_blank" class="btn btn-success">
                                WhatsApp<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PRESS / LINKS --}}
    <section class="max-w-5xl mx-auto px-4 md:px-6 py-14">
        <div class="prose max-w-none">
            <h2 class="text-3xl mb-4">Press</h2>
            <p class="text-xl">
                Want to read more about Eindhoven Cycling Tours?
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mt-8">
            <a href="https://archive.ph/c6V3g" target="_blank"
               class="card  bg-base-100/80 rj-shadow-inset">
                <div class="card-body">
                    <h3 class="card-title">ED.nl article</h3>
                    <p class="text-sm opacity-80">
                        A feature about Maurice and the tours (archived link).
                    </p>
                    <div class="btn btn-accent   mt-4">Read the article →</div>
                </div>
            </a>

            <a href="{{ route('tours.index') }}"
               class="card bg-base-100/80 rj-shadow-inset">
                <div class="card-body">
                    <h3 class="card-title">Explore the tours</h3>
                    <p class="text-sm opacity-80">
                        See all routes, prices, and available dates.
                    </p>
                    <div class="btn btn-accent   mt-4">View tours →</div>
                </div>
            </a>
        </div>
    </section>

    {{-- FINAL CTA --}}
    <section class="bg-accent text-accent-content">
        <div class="max-w-6xl mx-auto px-4 md:px-6 py-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-bold">Ready to ride?</h2>
                <p class="opacity-90 mt-1">Pick a tour, choose a date, and join the group.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('tours.index') }}" class="btn btn-neutral">Book a tour</a>
                <a href="{{ route('contact.show') }}" class="btn btn-outline border-accent-content text-accent-content">
                    Ask a question
                </a>
            </div>
        </div>
    </section>
@endsection
