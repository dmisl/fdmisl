<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public $fillable = [
        'id', 'request_from', 'request_to',
        'type'
    ];
}
