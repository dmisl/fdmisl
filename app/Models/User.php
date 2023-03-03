<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $fillable = [
        'id', 'name', 'email', 'avatar', 'status',
        'password',
    ];

    protected $hidden = [
        'password'
    ];
}
