<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'day', 'time', 'customer', 'status', 'priority'
    ];
}
