<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePost extends Model
{
    public $fillable = [
        'user_id', 'user_name', 'posted_to',
        'text', 'image', 
    ];
}
