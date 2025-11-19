<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        return view('payments.show', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'method' => 'required|in:credit_card,debit_card,paypal,cash'
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'method' => $validated['method'],
            'status' => 'paid',
            'transaction_id' => 'TX-' . strtoupper(uniqid()),
        ]);

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('rooms.index')
            ->with('success', 'Payment successful and booking confirmed!');
    }
}
