@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-20">

        <h1 class="text-3xl font-bold mb-6">Contact us</h1>

        @if(session('success'))
            <div class="alert alert-success mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.submit') }}" class="mt-4 bg-neutral-content/60 p-4 rounded-lg shadow-lg max-w-2xl">
            @csrf

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend mb-2">Name</legend>
                <input type="text" class="input validator w-full" placeholder="Jane Doe" name="name" value="{{ old('name') }}"/>
                @error('name')<p class="validator-hint">{{ $message }}</p>@enderror
            </fieldset>

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend mb-2">E-mail</legend>
                <input type="email" class="input validator w-full" placeholder="person@example.com" name="email" value="{{ old('name') }}" required/>
                @error('email')<p class="validator-hint">{{ $message }}</p>@enderror
            </fieldset>

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend mb-2">Phone</legend>
                <input name="phone" class="input validator w-full" placeholder="06-12345678" value="{{ old('phone') }}"/>
                <p class="label text-sm opacity-70">Optional</p>
                @error('phone')<p class="validator-hint">{{ $message }}</p>@enderror
            </fieldset>

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend mb-2">Subject</legend>
                <select class="select" name="subject">
                    <option disabled selected>Pick a subject</option>
                    <option>Booking question</option>
                    <option>Private Tour</option>
                    <option>Other</option>
                </select>
                @error('subject')<p class="validator-hint">{{ $message }}</p>@enderror
            </fieldset>
            <input type="text" name="company" class="hidden">

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend mb-2">Message</legend>
                <textarea name="message" class="textarea validator w-full" placeholder="Your message" rows="5">{{ old('message') }}</textarea>
                @error('message')<p class="validator-hint">{{ $message }}</p>@enderror
            </fieldset>


            <button class="btn btn-primary">
                Send message
            </button>

        </form>


    </section>

@endsection
