<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // <- Must extend Authenticatable
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass assignment allowed
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Hide sensitive fields
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
