<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_number', 'room_type', 'capacity', 'base_price',
        'description', 'status', 'features', 'amenities'
    ];

    // Cast JSON strings to arrays automatically
    protected $casts = [
        'features' => 'array',
        'amenities' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
