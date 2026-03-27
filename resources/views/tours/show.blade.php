@extends('layouts.app')
@section('title', $tour->title)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($tour->introduction ?: $tour->description), 155))
@section('canonical', route('tours.show', $tour))
@section('og_type', 'product')
@section('meta_image', $tour->cover_url ?: asset('/images/EHVCT-cover-img.jpg'))
@section('schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BreadcrumbList",
          "itemListElement": [
            {
              "@type": "ListItem",
              "position": 1,
              "name": "Home",
              "item": "{{ route('home') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Tours",
      "item": "{{ route('tours.index') }}"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": @json($tour->title),
      "item": "{{ route('tours.show', $tour) }}"
    }
  ]
}
    </script>
    @php
        $lowestPrice = $tour->variants->min('price_per_person_cents');
        $bookableVariant = $tour->variants->first();
        $inStock = $tour->variants->flatMap->slots->contains(fn($slot) => $slot->isBookableNow());
    @endphp
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Product",
          "name": @json($tour->title),
  "description": @json(\Illuminate\Support\Str::limit(strip_tags($tour->introduction ?: $tour->description), 300)),
  "image": [
        @json($tour->cover_url ?: asset('/images/EHVCT-cover-img.jpg'))
        ],
        "brand": {
          "@type": "Brand",
          "name": "Eindhoven Cycling Tours"
        },
        "offers": {
          "@type": "Offer",
          "priceCurrency": "EUR",
          "price": "{{ $lowestPrice ? number_format($lowestPrice / 100, 2, '.', '') : '0.00' }}",
    "availability": "{{ $inStock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
    "url": "{{ route('tours.show', $tour) }}"
  }
}
    </script>
@endsection
@section('content')
    <section class="max-w-7xl mx-auto px-4 pt-24 pb-16">

        {{-- Breadcrumbs --}}
        <div class="breadcrumbs text-md mb-6">
            <ul>
                <li><a href="{{ route('home') }}" class="link">Home</a></li>
                <li><a href="{{ route('tours.index') }}" class="link">Tours</a></li>
                <li>{{ $tour->title }}</li>
            </ul>
        </div>


        {{-- Top product-style layout --}}
        <article
            class="flex flex-wrap justify-center md:grid md:grid-cols-[repeat(auto-fit,min(100%,20rem))] gap-4 place-items-end">

            {{-- Cover image --}}
            <section class="order-1 sticky top-0">
                @if($tour->cover_url)
                    <figure
                        class="max-w-[100%] md:static sm:max-w-[350px] overflow-hidden rounded-2xl rj-shadow-inset bg-base-200 border border-base-300 mx-auto">
                        <img
                            src="{{ $tour->cover_url }}"
                            alt="{{ $tour->cover_media?->alt_text ?? $tour->title }}"
                            class="w-full aspect-[3/4] object-cover"
                        >
                    </figure>
                @else
                    <div
                        class="aspect-[3/4] rounded-2xl bg-base-200 border border-base-300 flex items-center justify-center text-sm opacity-60 ">
                        No image available
                    </div>
                @endif
            </section>

            {{-- Main info --}}
            <section class="order-2 min-w-0 z-10">
                <div class="bg-base-100/90 rounded-2xl p-6 md:p-8 rj-card-inset">
                    <header>
                        <h1 class="text-3xl md:text-4xl font-bold leading-tight">
                            {{ $tour->title }}
                        </h1>

                        @if($tour->introduction)
                            <div class="mt-5 text-lg leading-8 max-w-3xl prose prose-lg max-w-none">
                                {!! $tour->introduction !!}
                            </div>
                        @endif

                    </header>
                    {{-- Quick facts --}}
                    <div class="mt-6 flex flex-wrap gap-3">
                        @if($tour->variants->count())
                            @php
                                $lowestPrice = $tour->variants->min('price_per_person_cents');
                                $shortestDuration = $tour->variants->min('duration_minutes');
                            @endphp

                            @if($lowestPrice)
                                <div class="badge badge-lg badge-outline">
                                    €{{ number_format($lowestPrice / 100, 2) }} p.p.
                                </div>
                            @endif

                            @if($shortestDuration)
                                <div class="badge badge-lg badge-outline">
                                    {{ number_format($shortestDuration / 60, 1) }} hours+
                                </div>
                            @endif
                        @endif

                    </div>


                </div>
            </section>

            {{-- Booking card --}}
            <aside id="booking-card" class="z-10 order-3 w-full">
                <div class="card bg-base-100/90 rounded-2xl overflow-hidden rj-card-inset">
                    <div class="card-body p-0">
                        <div class="bg-accent/80 text-accent-content px-6 py-5">
                            <h2 class="text-2xl font-bold">Book this tour</h2>
                            <p class="text-sm opacity-90 mt-1">
                                Choose a date and reserve your spot.
                            </p>
                        </div>

                        <div class="p-5 space-y-4">
                            @foreach($tour->variants as $variant)
                                @php
                                    $slots = $variant->slots->filter(fn($s) => $s->isBookableNow());
                                @endphp

                                <div
                                    class="rounded-xl bg-base-200/40 p-4 shadow-lg border-[6px] border-neutral-200/90 rj-card-inset">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3 class="font-semibold text-lg">{{ $variant->label }}</h3>
                                            <p class="text-sm opacity-70">
                                                {{ number_format($variant->duration_minutes / 60, 1) }} hours
                                            </p>
                                        </div>
                                        <div class="text-lg font-bold whitespace-nowrap">
                                            €{{ number_format($variant->price_per_person_cents / 100, 2) }}
                                        </div>
                                    </div>

                                    <div class="mt-4 space-y-3">
                                        @forelse($slots as $slot)
                                            <div class="rounded-xl bg-base-100/40 border border-base-300 p-3">
                                                <div class="flex items-center justify-between gap-3 mb-3">
                                                    <div class="text-sm font-medium">
                                                        {{ $slot->starts_at->format('D d M, H:i') }}
                                                    </div>
                                                    <div class="text-xs opacity-70">
                                                        {{ $slot->remainingSeats() }} seats left
                                                    </div>
                                                </div>

                                                <a href="{{ route('bookings.create', $slot) }}"
                                                   class="btn btn-accent btn-sm w-full">
                                                    Book this date
                                                </a>
                                            </div>
                                        @empty
                                            <p class="text-sm opacity-70">
                                                No bookable slots right now.
                                            </p>
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-xs opacity-90">
                                Questions before booking?
                                <a href="{{ route('contact.show') }}" class="link">Contact us</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </article>

        {{-- Lower content --}}
        <section class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_22rem] gap-4 mt-4 items-start">

            {{-- Description --}}
            <div class="bg-base-100/90 rounded-2xl p-6 md:p-8 rj-card-inset">
                <h2 class="text-2xl font-bold mb-5">About this tour</h2>

                @if($tour->description)
                    <div class="prose prose-lg max-w-none rj-description">
                        {!! $tour->description !!}
                    </div>
                @endif
            </div>

            {{-- Side info cards --}}
            <div class="space-y-6">

                @if($tour->highlights)
                    <div
                        class="card bg-base-100/90 shadow-lg border-[6px] border-neutral-200/90 rj-card-inset drop-shadow-lg">
                        <div class="card-body">
                            <h3 class="card-title text-xl">Highlights</h3>
                            <div class="prose max-w-none">
                                {!! $tour->highlights !!}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card bg-base-100/90 rounded-2xl shadow-lg border-[6px] border-neutral-200/90 rj-card-inset">
                    <div class="card-body">
                        <h3 class="card-title text-xl">Meeting point</h3>

                        @if ($tour->meeting_point)
                            @if ($tour->meeting_point_map_url)
                                <a href="{{ $tour->meeting_point_map_url }}"
                                   title="View meeting point on map"
                                   target="_blank"
                                   class="link inline-flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round"
                                         class="shrink-0 mt-0.5">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                                        <path
                                            d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0"/>
                                    </svg>
                                    <span>{{ $tour->meeting_point }}</span>
                                </a>
                            @else
                                <p>{{ $tour->meeting_point }}</p>
                            @endif
                        @else
                            <p class="opacity-70">To be confirmed</p>
                        @endif
                    </div>
                </div>

                <div class="card bg-base-100/90 rounded-2xl shadow-lg border-[6px] border-neutral-200/90 rj-card-inset">
                    <div class="card-body">
                        <h3 class="card-title text-xl">Good to know</h3>
                        <ul class="space-y-2 text-sm opacity-80">
                            <li>Relaxed, guided group ride</li>
                            <li>Please arrive a little before the start time</li>
                            <li>Bring weather-appropriate clothing</li>
                            <li>Need a bike? Ask about rental options</li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>
        <section class="bg-base-100/80 rounded-2xl mt-4">
            <div class="max-w-4xl mx-auto px-4 py-8">
                <h2 class="text-3xl font-bold mb-3 text-center">Frequently asked questions</h2>
                <p class="text-center opacity-75 max-w-2xl mx-auto mb-8">
                    Practical questions about our guided cycling tours in Eindhoven, from bikes and children to weather
                    and cancellations.
                </p>

                <div class="space-y-4">

                    <div class="collapse collapse-arrow bg-base-100 border border-base-300 rj-shadow-inset">
                        <input type="radio" name="faq-accordion" checked="checked"/>
                        <div class="collapse-title font-semibold">
                            Do I need to bring my own bike?
                        </div>
                        <div class="collapse-content text-sm opacity-80">
                            You can bring your own bike or rent one nearby in Eindhoven. We can recommend a local rental
                            partner <a href="https://velorent.nl" target="_blank" title="velorent bike rentals"></a>.
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-100 border border-base-300 rj-shadow-inset">
                        <input type="radio" name="faq-accordion"/>
                        <div class="collapse-title font-semibold">
                            Can I bring my children on the tour? And is my dog allowed in a bike basket?
                        </div>
                        <div class="collapse-content text-sm opacity-80">
                            Of course! Children are very welcome to join our tours. They only need a ticket if they ride
                            their own bike. If your child sits in a child seat on your bike, they can join for free. And
                            your dog is welcome too!
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-100 border border-base-300 rj-shadow-inset">
                        <input type="radio" name="faq-accordion"/>
                        <div class="collapse-title font-semibold">
                            How difficult are the tours?
                        </div>
                        <div class="collapse-content text-sm opacity-80">
                            The tours are relaxed and beginner-friendly. We keep a comfortable pace and take regular
                            breaks. You do not need to be sporty to join.
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-100 border border-base-300 rj-shadow-inset">
                        <input type="radio" name="faq-accordion"/>
                        <div class="collapse-title font-semibold">
                            What happens if the weather is bad?
                        </div>
                        <div class="collapse-content text-sm opacity-80">
                            Light rain is usually not a problem. If conditions are unsafe, the tour may be rescheduled
                            or refunded.
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-100 border border-base-300 rj-shadow-inset">
                        <input type="radio" name="faq-accordion"/>
                        <div class="collapse-title font-semibold">
                            Can I cancel my booking?
                        </div>
                        <div class="collapse-content text-sm opacity-80">
                            Yes. You can cancel up to the allowed cutoff time before the tour starts. Please check the
                            <a href="{{ route('terms-of-service') }}">booking and cancellation policy</a> for the exact
                            rules.
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-100 border border-base-300 rj-shadow-inset">
                        <input type="radio" name="faq-accordion"/>
                        <div class="collapse-title font-semibold">
                            Is the tour in English or Dutch?
                        </div>
                        <div class="collapse-content text-sm opacity-80">
                            Both. Maurice speaks English and Dutch, so expats, internationals, and locals can all join
                            comfortably.
                        </div>
                    </div>

                    <div class="collapse collapse-arrow bg-base-100 border border-base-300 rj-shadow-inset">
                        <input type="radio" name="faq-accordion"/>
                        <div class="collapse-title font-semibold">
                            Where do the tours start?
                        </div>
                        <div class="collapse-content text-sm opacity-80">
                            The exact meeting point is shown on each tour page and in your booking confirmation.
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </section>

@endsection
