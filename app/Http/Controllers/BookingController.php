<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Services\MolliePayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Slot $slot)
    {
        $slot->load('variant.tour');

        abort_unless($slot->isBookableNow(), 404);

        $variant = $slot->variant;
        $tour = $variant->tour;

        return view('bookings.create', compact('slot', 'variant', 'tour'));
    }

    /**
     * @throws \Throwable
     */
    public function store(Request $request, Slot $slot, MolliePayments $mollie)
    {
        $slot->load('variant.tour');

        if (! $slot->isBookableNow()) {
            return back()->with('error', 'This slot is no longer bookable.')->withInput();
        }

        $data = $request->validate([
            'name' => ['required','string','max:120'],
            'email' => ['required','email','max:190'],
            'phone' => ['nullable','string','max:40'],
            'people_count' => ['required','integer','min:1'],
        ]);

        $variant = $slot->variant;

        // Overbooking-safe transaction: lock slot row, re-check remaining seats
        $booking = DB::transaction(function () use ($slot, $variant, $data) {
            $lockedSlot = Slot::whereKey($slot->id)->lockForUpdate()->firstOrFail();

            $people = (int) $data['people_count'];

            if ($people < (int) $lockedSlot->min_people || $people > (int) $lockedSlot->max_people) {
                throw new \RuntimeException('Invalid number of people for this slot.');
            }

            $remaining = $lockedSlot->remainingSeats();
            if ($people > $remaining) {
                throw new \RuntimeException('Not enough seats left for this slot.');
            }

            $unit = (int) $variant->price_per_person_cents;
            $total = $unit * $people;

            return Booking::create([
                'slot_id' => $lockedSlot->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'people_count' => $people,
                'unit_price_cents' => $unit,
                'total_amount_cents' => $total,
                'currency' => $variant->currency ?? 'EUR',
                'status' => 'pending',
            ]);
        });

        // Create Mollie payment and redirect
        $checkoutUrl = $mollie->createPaymentForBooking($booking);

        return redirect()->away($checkoutUrl);
    }
}
