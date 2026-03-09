@extends('layouts.app')
@section('title','Tours')
@section('content')
    <section class="max-w-6xl mx-auto px-4 py-20">

        <header class="pb-4">
            <h1 class="text-3xl font-bold mb-6">Our tours</h1>
            <p>
                Find the tour that fits you best!
            </p>
        </header>


        <div class="overflow-x-auto  max-w-fit mx-auto mb-8 bg-base-100/60 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold p-4 bg-base-100/60 rounded-t-xl border-b" style="border-color: #2228">Upcoming tours
            </h2>
            <table class="table table-sm">
                <tbody>
                <thead>
                <tr style="border-bottom-color: #2222">
                    <th>Tour</th>
                    <th>Upcoming date</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                </thead>

                @forelse($upcomingTours as $upTour)
                    <tr style="border-bottom-color: #2222" class="hover:bg-base-100/80">
                        <td>
                            <p class="font-bold">{{ $upTour->title }}</p>
                        </td>
                        <td>
                            @if($upTour->next_slot_at)
                                <p class="text-sm text-balance">
                                    {{ \Illuminate\Support\Carbon::parse($upTour->next_slot_at)->format('D d M, H:i') }}
                                </p>
                            @endif
                        </td>
                        <td>
                            @if($upTour->starting_from_cents !== null)
                                <p
                                    class="font-semibold">from<br> {{ $upTour->starting_from_formatted }}
                                </p>
                            @endif
                        </td>
                        <th>
                            <a href="/tours/{{ $upTour->slug }}" class="btn btn-accent btn-sm">View</a>
                        </th>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No upcoming tours</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mx-auto grid grid-cols-[repeat(auto-fit,min(100%,18rem))] place-content-center gap-4">
            @forelse($tours as $tour)
                <article
                    class="bg-white/80 shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                    <h3 class="text-lg font-bold text-black truncate block capitalize py-2 px-4">{{ $tour->title }}</h3>

                    <a href="{{ route('tours.show', $tour) }}" title="{{ $tour->title }}">
                        @if($tour->cover_url)
                            <figure class="aspect-[16/10] h-80 w-full object-cover rounded-t-xl">
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
                                        <div
                                            class="text-lg font-semibold">{{ $tour->starting_from_formatted }}</div>
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

        <section class="max-w-6xl mx-auto px-4 py-14">

@endsection
