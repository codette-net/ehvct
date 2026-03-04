@extends('layouts.app')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-14">

        <div class="breadcrumbs text-sm mb-4">
            <ul>
                <li><a href="{{ route('tours.index') }}">Tours</a></li>
                <li><a href="{{ route('tours.show', $tour) }}">{{ $tour->title }}</a></li>
                <li>Book</li>
            </ul>
        </div>

        <h1 class="text-3xl font-bold">Book your tour</h1>

        <div class="mt-4 bg-neutral-content/60 p-4 rounded-lg shadow-lg max-w-4xl">
            <div class="card-body">
                <div class="grid grid-cols-2 flex-none gap-8 bg-neutral-content/60 p-4 items-end justify-center border-gray-500 rounded-md shadow-sm ">
                    <div class="flex flex-col flex-none gap-2 border-r pr-4">
                        <div class="font-semibold">{{ $tour->title }}</div>
                        <div class="text-sm opacity-70">{{ $variant->label }}</div>
                        <div class="text-sm opacity-70">{{ $slot->starts_at->format('D d M Y, H:i') }}</div>
                    </div>
                    <p class="text-center flex-none">
                        <span class="font-semibold text-lg">
                            €{{ number_format($variant->price_per_person_cents / 100, 2) }}
                        </span> <span class="text-sm opacity-70">per person</span>
                    </p>
                </div>

                @if(session('error'))
                    <div class="alert alert-error mt-4">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('bookings.store', $slot) }}" class="mt-6 space-y-4">
                    @csrf

                    <div class="steps steps-horizontal">
                        <div class="step step-primary">Details</div>
                        <div class="step">Payment</div>
                        <div class="step">Confirmation</div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <label class="form-control">
                            <div class="label"><span class="label-text">Name</span></div>
                            <input name="name" value="{{ old('name') }}" class="input input-bordered" required>
                            @error('name')<div class="text-error text-sm mt-1">{{ $message }}</div>@enderror
                        </label>

                        <label class="form-control">
                            <div class="label"><span class="label-text">Email</span></div>
                            <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered" required>
                            @error('email')<div class="text-error text-sm mt-1">{{ $message }}</div>@enderror
                        </label>

                        <label class="form-control">
                            <div class="label"><span class="label-text">Phone (optional)</span></div>
                            <input name="phone" value="{{ old('phone') }}" class="input input-bordered">
                            @error('phone')<div class="text-error text-sm mt-1">{{ $message }}</div>@enderror
                        </label>

                        <label class="form-control">
                            <div class="label"><span class="label-text">People</span></div>
                            <input type="number" min="{{ $slot->min_people }}" max="{{ $slot->max_people }}"
                                   name="people_count" value="{{ old('people_count', max(1, $slot->min_people)) }}"
                                   class="input input-bordered" required>
                            <div class="label">
                            <span class="label-text-alt opacity-70">
                                Min {{ $slot->min_people }}, Max {{ $slot->max_people }}
                            </span>
                            </div>
                            @error('people_count')<div class="text-error text-sm mt-1">{{ $message }}</div>@enderror
                        </label>
                    </div>

                    <div class="divider"></div>

                    <div class="flex justify-between items-center">
                        <div class="opacity-70 text-sm">
                            You will pay securely via Mollie.
                        </div>
                        <button class="btn btn-primary">
                            Continue to payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
