@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-14">

    <h1 class="text-3xl font-bold mb-6">Tours</h1>

    <div class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-y-20 gap-x-14 mt-10 mb-5">
        @forelse($tours as $tour)
{{--            <a href="{{ route('tours.show', $tour) }}" class="card bg-base-100 border hover:shadow-md transition">--}}
{{--                <div class="card-body">--}}
{{--                    <h2 class="card-title">{{ $tour->title }}</h2>--}}
{{--                    <p class="opacity-70 line-clamp-3">{!! $tour->highlights ?: '' !!}</p>--}}
{{--                    <div class="card-actions justify-end mt-2">--}}
{{--                        <span class="btn btn-primary btn-sm">View</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                <a href="{{ route('tours.show', $tour) }}" title="{{ $tour->title }}">
                    @if($tour->cover_url)
                        <figure class="aspect-[16/10] h-80 w-72 object-cover rounded-t-xl">
                            <img src="{{ $tour->cover_url }}" alt="{{ $tour->cover_media?->alt_text ?? $tour->title }}" class="w-full h-full object-cover">
                        </figure>
                    @else
                        <div class="aspect-[16/10] bg-base-200 flex items-center justify-center opacity-70">
                            No image yet
                        </div>
                    @endif
{{--                    <img src="{{ $tour  }}" alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />--}}
                    <div class="px-4 py-3 w-72">
{{--                        <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>--}}
                        <p class="text-lg font-bold text-black truncate block capitalize">{{ $tour->title }}</p>
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
            </div>
        @empty
            <p>No tours yet.</p>
        @endforelse
    </div>
        <section class="max-w-6xl mx-auto px-4 py-14">

@endsection
