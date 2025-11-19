<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function show(Room $room)
    {
        // Eager load images and bookings if needed
        $room->load('images', 'bookings');

        // Load reviews if you have a Review model
        $reviews = $room->reviews ?? collect();

        return view('rooms.show', compact('room', 'reviews'));
    }
}
