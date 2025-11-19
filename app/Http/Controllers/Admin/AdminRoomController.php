<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Support\Facades\Storage;

class AdminRoomController extends Controller
{
    // Show list of rooms
    public function index()
    {
        $rooms = Room::with('images')->latest()->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    // Show a single room (for the Blade "show" page)
    public function show(Room $room)
    {
        $room->load('images'); // eager load images
        // Features and amenities are already cast to array
        return view('admin.rooms.show', compact('room'));
    }

    // Show form to create a room
    public function create()
    {
        return view('admin.rooms.create');
    }

    // Store a new room
    public function store(Request $request)
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'features' => 'nullable|array',
            'amenities' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $room = Room::create([
            'room_type' => $request->room_type,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'features' => $request->features,
            'amenities' => $request->amenities,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms', 'public');
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_url' => $path,
                ]);
            }
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully.');
    }

    // Show form to edit a room
    public function edit(Room $room)
    {
        $room->load('images');
        return view('admin.rooms.edit', compact('room'));
    }

    // Update an existing room
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'description' => 'required|string',
            'base_price' => 'required|numeric|min:0',
            'features' => 'nullable|array',
            'amenities' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $room->update([
            'room_type' => $request->room_type,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'features' => $request->features,
            'amenities' => $request->amenities,
        ]);

        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($room->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_url);
                $oldImage->delete();
            }

            // Save new images
            foreach ($request->file('images') as $image) {
                $path = $image->store('rooms', 'public');
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_url' => $path,
                ]);
            }
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully.');
    }

    // Delete a room
    public function destroy(Room $room)
    {
        // Delete images
        foreach ($room->images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
