<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendList extends Model
{
    public $fillable = [
        'id', 'user', 'friend',
    ];
}
