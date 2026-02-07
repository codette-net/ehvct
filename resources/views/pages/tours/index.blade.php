@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Tours</h1>

    <div class="grid gap-6 md:grid-cols-2">
        @forelse($tours as $tour)
            <a href="{{ route('tours.show', $tour) }}" class="block rounded border p-4 hover:bg-slate-50">
                <div class="font-semibold">{{ $tour->title }}</div>
                <div class="text-sm text-slate-600 mt-1 line-clamp-3">{{ $tour->description }}</div>
            </a>
        @empty
            <p class="text-slate-600">No tours yet.</p>
        @endforelse
    </div>
@endsection
