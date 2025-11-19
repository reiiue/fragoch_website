<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Guest extends Authenticatable
{
    protected $fillable = [
        'first_name', 'last_name', 'email',
        'phone', 'password'
    ];

    protected $hidden = ['password'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
