<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $fillable = [
        'id', 'name', 'email', 'avatar',
        'password',
    ];

    protected $hidden = [
        'password'
    ];
}
