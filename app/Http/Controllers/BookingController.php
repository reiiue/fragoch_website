<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Guest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Show the booking page.
     */
    public function create(Request $request, Room $room)
    {
        
        $rooms = Room::all();       // you should have a Room model/table
        $checkIn = $request->query('check_in_date', now()->format('Y-m-d'));
        $checkOut = $request->query('check_out_date', now()->addDay()->format('Y-m-d'));
        $numberOfRooms = $request->query('number_of_rooms', 1);
        return view('booking', compact('rooms'));
    }

    /**
     * Store a new booking.
     */
    public function store(Request $request)
{
    $user = auth()->user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in to make a booking.');
    }

    // Validate the incoming request
    $validated = $request->validate([
        'phone' => 'required|string|max:20',
        'checkIn' => 'required|date|after_or_equal:today',
        'checkOut' => 'required|date|after:checkIn',
        'roomType' => 'required|exists:rooms,id',
        'rooms' => 'required|integer|min:1',
        'guests' => 'required|integer|min:1',
        'specialRequests' => 'nullable|string|max:1000',
    ]);

    // Update user's phone number
    $user->phone_num = $validated['phone'];
    $user->save();

    // Find the selected room
    $room = Room::findOrFail($validated['roomType']);

    // Calculate number of nights
    $nights = Carbon::parse($validated['checkIn'])
                   ->diffInDays(Carbon::parse($validated['checkOut']));

    // Calculate total price
    $totalPrice = $room->base_price * $validated['rooms'] * $nights;

    // Create booking in database
    $booking = Booking::create([
        'guest_id' => $user->id,
        'room_id' => $room->id,
        'check_in_date' => $validated['checkIn'],
        'check_out_date' => $validated['checkOut'],
        'number_of_rooms' => $validated['rooms'],    // updated field name
        'number_of_guests' => $validated['guests'],  // updated field name
        'special_requests' => $validated['specialRequests'] ?? null,
        'total_price' => $totalPrice,
        'status' => 'pending',
        'booking_ref' => 'FRGCH' . now()->year . '-' . Str::upper(Str::random(10)), // dynamic unique ref
    ]);

    // Redirect to booking confirmation page
    return redirect()->route('booking.confirmation', $booking);
}



        // Handle confirmation page
public function confirmation(Booking $booking)
{
    // Eager load room and user to avoid null relations
    $booking->load('room', 'user');

    return view('bookings.confirmation', [
        'confirmationData' => $booking,
        'user' => $booking->user, // so you can use $user in Blade
    ]);
}

}
