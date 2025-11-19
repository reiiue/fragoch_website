<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $fillable = [
        'username', 'password', 'role'
    ];

    protected $hidden = ['password'];

    public function isManager()
    {
        return in_array($this->role, ['manager', 'superadmin']);
    }
}
