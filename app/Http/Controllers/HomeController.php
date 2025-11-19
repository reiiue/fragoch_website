<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch some rooms to display on landing page
        $rooms = Room::with('images')->take(6)->get();
        return view('home', compact('rooms'));
    }
}
