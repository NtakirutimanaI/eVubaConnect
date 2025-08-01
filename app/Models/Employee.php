<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Employee extends Model
{
    use Notifiable;
    // Mass assignable fields
    protected $fillable = [
        'name', 'position', 'email', 'status','expertise',
    ];
}
