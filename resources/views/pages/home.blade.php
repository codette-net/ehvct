@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <h1 class="text-3xl font-bold">Explore Eindhoven by bike</h1>
        <p class="text-slate-700 max-w-2xl">
            Guided cycling tours for expats and tourists. Pick a date, reserve your spot, and pay securely online.
        </p>
        <a class="inline-flex items-center rounded bg-slate-900 px-4 py-2 text-white"
           href="{{ route('tours.index') }}">
            View tours
        </a>
    </div>
@endsection
