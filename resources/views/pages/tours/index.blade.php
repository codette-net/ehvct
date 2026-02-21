@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Tours</h1>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tours as $tour)
            <a href="{{ route('tours.show', $tour) }}" class="card bg-base-100 border hover:shadow-md transition">
                <div class="card-body">
                    <h2 class="card-title">{{ $tour->title }}</h2>
                    <p class="opacity-70 line-clamp-3">{!! $tour->highlights ?: '' !!}</p>
                    <div class="card-actions justify-end mt-2">
                        <span class="btn btn-primary btn-sm">View</span>
                    </div>
                </div>
            </a>
        @empty
            <p>No tours yet.</p>
        @endforelse
    </div>
@endsection
