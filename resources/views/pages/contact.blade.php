@extends('layouts.app')
@section('title','Contact')
@section('title', 'Contact')
@section('meta_description', 'Contact Eindhoven Cycling Tours for questions, private tours, team rides, or booking help.')
@section('canonical', route('contact.show'))
@section('schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "ContactPage",
          "name": "Contact Eindhoven Cycling Tours",
          "url": "{{ route('contact.show') }}"
}
    </script>
@endsection
@section('content')
    <section class="max-w-6xl mx-auto px-4 py-20 my-8">

        <h1 class="text-3xl font-bold mb-6">Contact us</h1>
        <p class="text-lg mt-4">
          If you have any questions about the tours, a booking or you just want to get in touch, please use the form below.
        </p>

        <form method="POST" action="{{ route('contact.submit') }}" class="mt-4 bg-neutral-content/60 p-4 rounded-lg shadow-lg max-w-2xl">
            @csrf
            @if(isset($tour) && $tour)
                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
            @endif

            @if(isset($slot) && $slot)
                <input type="hidden" name="slot_id" value="{{ $slot->id }}">
            @endif
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
                <input name="phone" class="input validator w-full" placeholder="+31 (0)612345678" value="{{ old('phone') }}"/>
                <p class="label text-sm opacity-70">Optional</p>
                @error('phone')<p class="validator-hint">{{ $message }}</p>@enderror
            </fieldset>

            <fieldset class="fieldset mb-4">
                <legend class="fieldset-legend mb-2">Subject</legend>
                <select class="select" name="subject">
                    @if(isset($slot) && $slot)
                        <option disabled >Pick a subject</option>
                     <option selected>{{ $slot->variant->tour->title}}, {{ $slot->starts_at->format('D d M Y, H:i') }}</option>
                        @elseif(isset($tour) && $tour)
                        <option disabled >Pick a subject</option>
                        <option selected>{{ $tour->title }}</option>
                    @else
                        <option selected disabled >Pick a subject</option>
                    @endif
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
