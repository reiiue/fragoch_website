<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'booking_id', 'action', 'old_value',
        'new_value', 'executed_by', 'executed_at'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
