@extends('layouts.app')

@section('content')
    <section class="relative">

        <div class="w-full max-w-6xl mx-auto px-4 md:px-6 py-16 md:py-20">

            {{-- Header --}}
            <div class="text-center max-w-2xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold">Impressions</h1>
                <p class="mt-4 text-base md:text-lg opacity-80">
                    A small look at the rides, the people, and the scenery around Eindhoven.
                    Easy-going cycling, great stops, good company.
                </p>

                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('tours.index') }}" class="btn btn-accent">Book a tour</a>
                    <a href="{{ route('tours.index') }}" class="btn btn-outline">See all tours</a>
                    <a href="https://wa.link/uk5101" target="_blank" class="btn btn-ghost">Ask on WhatsApp</a>
                </div>
            </div>

            {{-- Quick highlights --}}
            <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <div class="card bg-base-100 border border-base-200">
                    <div class="card-body p-4">
                        <div class="text-sm font-semibold">Relaxed pace</div>
                        <div class="text-xs opacity-70">Beginner-friendly rides</div>
                    </div>
                </div>
                <div class="card bg-base-100 border border-base-200">
                    <div class="card-body p-4">
                        <div class="text-sm font-semibold">Nature & villages</div>
                        <div class="text-xs opacity-70">Brabant highlights</div>
                    </div>
                </div>
                <div class="card bg-base-100 border border-base-200">
                    <div class="card-body p-4">
                        <div class="text-sm font-semibold">Small groups</div>
                        <div class="text-xs opacity-70">Social, not crowded</div>
                    </div>
                </div>
                <div class="card bg-base-100 border border-base-200">
                    <div class="card-body p-4">
                        <div class="text-sm font-semibold">Local guide</div>
                        <div class="text-xs opacity-70">English + Dutch</div>
                    </div>
                </div>
            </div>

            {{-- Masonry grid (with optional lightbox) --}}
            <div class="mt-12">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    {{-- Column 1 --}}
                    <div class="grid auto-rows-max gap-4">
                        @foreach ([
                            ['/images/EHVCT_8.jpg', 'Group ride near Eindhoven'],
                            ['/images/EHVCT_21.jpg', 'Brabant countryside'],
                            ['/images/EHVCT-heide-path.jpg', 'Heide path']
                        ] as [$src, $alt])
                            <label for="img-modal" class="cursor-pointer">
                                <img class="w-full rounded-xl shadow hover:shadow-md transition" src="{{ $src }}" alt="{{ $alt }}"
                                     onclick="window.__EHVCT_IMG='{{ $src }}'; window.__EHVCT_ALT='{{ $alt }}'; document.getElementById('modal-img').src=window.__EHVCT_IMG; document.getElementById('modal-img').alt=window.__EHVCT_ALT;" />
                            </label>
                        @endforeach
                    </div>

                    {{-- Column 2 --}}
                    <div class="grid auto-rows-max gap-4">
                        @foreach ([
                            ['/images/EHVCT_16.jpg', 'Cycling together'],
                            ['/images/EHVCT-shroom-wheel.jpg', 'Small details on the ride'],
                            ['/images/EHVCT_18.jpg', 'Tour moment']
                        ] as [$src, $alt])
                            <label for="img-modal" class="cursor-pointer">
                                <img class="w-full rounded-xl shadow hover:shadow-md transition" src="{{ $src }}" alt="{{ $alt }}"
                                     onclick="window.__EHVCT_IMG='{{ $src }}'; window.__EHVCT_ALT='{{ $alt }}'; document.getElementById('modal-img').src=window.__EHVCT_IMG; document.getElementById('modal-img').alt=window.__EHVCT_ALT;" />
                            </label>
                        @endforeach
                    </div>

                    {{-- Column 3 --}}
                    <div class="grid auto-rows-max gap-4">
                        @foreach ([
                            ['/images/EHVCT_2.jpg', 'Nature stop'],
                            ['/images/EHVCT_0.jpg', 'Cycling path'],
                            ['/images/EHVCT_9.jpg', 'Brabant scenery']
                        ] as [$src, $alt])
                            <label for="img-modal" class="cursor-pointer">
                                <img class="w-full rounded-xl shadow hover:shadow-md transition" src="{{ $src }}" alt="{{ $alt }}"
                                     onclick="window.__EHVCT_IMG='{{ $src }}'; window.__EHVCT_ALT='{{ $alt }}'; document.getElementById('modal-img').src=window.__EHVCT_IMG; document.getElementById('modal-img').alt=window.__EHVCT_ALT;" />
                            </label>
                        @endforeach
                    </div>

                    {{-- Column 4 (replace external images with local ones) --}}
                    <div class="grid auto-rows-max gap-4">
                        @foreach ([
                            ['/images/EHVCT-van-gogh-path.jpg', 'Van Gogh bike path'],
                            ['/images/EHVCT-cover-img.jpg', 'EHVCT ride impression'],
                            ['/images/EHVCT_5.jpg', 'Tour moment']  {{-- change if you have a better local image --}}
                        ] as [$src, $alt])
                            <label for="img-modal" class="cursor-pointer">
                                <img class="w-full rounded-xl shadow hover:shadow-md transition" src="{{ $src }}" alt="{{ $alt }}"
                                     onclick="window.__EHVCT_IMG='{{ $src }}'; window.__EHVCT_ALT='{{ $alt }}'; document.getElementById('modal-img').src=window.__EHVCT_IMG; document.getElementById('modal-img').alt=window.__EHVCT_ALT;" />
                            </label>
                        @endforeach
                    </div>

                </div>
            </div>

            {{-- Bottom CTA --}}
            <div class="mt-14 text-center">
                <h2 class="text-2xl md:text-3xl font-bold">Want to be in the next photo?</h2>
                <p class="mt-3 opacity-80">Pick a tour, choose a date, and join the ride.</p>
                <div class="mt-6 flex justify-center gap-3">
                    <a href="{{ route('tours.index') }}" class="btn btn-accent">Book a tour</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline">Contact</a>
                </div>
            </div>

        </div>

        {{-- DaisyUI Modal (lightbox) --}}
        <input type="checkbox" id="img-modal" class="modal-toggle" />
        <div class="modal" role="dialog">
            <div class="modal-box max-w-4xl p-2">
                <img id="modal-img" src="" alt="" class="w-full rounded-lg" />
                <div class="modal-action">
                    <label for="img-modal" class="btn btn-sm">Close</label>
                </div>
            </div>
            <label class="modal-backdrop" for="img-modal">Close</label>
        </div>

    </section>
@endsection
