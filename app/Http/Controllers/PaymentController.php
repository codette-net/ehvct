<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class PaymentController extends Controller
{
    public function success(string $reference)
    {
        $booking = Booking::where('reference', $reference)->firstOrFail();
        return view('payments.success', compact('booking'));
    }
}
