<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'guest_id', 'room_id', 'check_in_date',
        'check_out_date', 'total_price', 'status', 'number_of_guests', 'number_of_rooms', 'booking_ref'
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function logs()
    {
        return $this->hasMany(BookingLog::class);
    }

        public function user()
    {
        return $this->belongsTo(User::class, 'guest_id'); // 'guest_id' is the FK to users
    }
}
