<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Slot;
use App\Services\MolliePayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function status(string $reference)
    {
        $booking = Booking::where('reference', $reference)
            ->with('slot.variant.tour')
            ->firstOrFail();

        return view('bookings.status', compact('booking'));
    }

    public function statusJson(string $reference)
    {
        $booking = Booking::where('reference', $reference)->firstOrFail();

        return response()->json([
            'status' => $booking->status,
            'updated_at' => optional($booking->updated_at)->toIso8601String(),
        ]);
    }

    public function create(Slot $slot)
    {
        $slot->load('variant.tour');

        abort_unless($slot->isBookableNow(), 404);

        $variant = $slot->variant;
        $tour = $variant->tour;

        return view('bookings.create', compact('slot', 'variant', 'tour'));
    }

    public function store(Request $request, Slot $slot, MolliePayments $mollie)
    {
        $slot->load('variant.tour');

        if (! $slot->isBookableNow()) {
            return back()
                ->withInput()
                ->with('error', 'This slot is no longer bookable.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'people_count' => ['required', 'integer', 'min:1'],
        ]);

        $variant = $slot->variant;

        try {
            $booking = DB::transaction(function () use ($slot, $variant, $data) {
                $lockedSlot = Slot::whereKey($slot->id)->lockForUpdate()->firstOrFail();

                $people = (int) $data['people_count'];

                if ($people < (int) $lockedSlot->min_people || $people > (int) $lockedSlot->max_people) {
                    throw new \DomainException('Invalid number of people for this slot.');
                }

                $remaining = $lockedSlot->remainingSeats();

                if ($people > $remaining) {
                    throw new \DomainException('Sorry, there are not enough seats left for this slot.');
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
        } catch (\DomainException $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        $checkoutUrl = $mollie->createPaymentForBooking($booking);

        return redirect()->away($checkoutUrl);
    }
}
