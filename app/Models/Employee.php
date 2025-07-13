<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'name', 'position', 'email', 'status','expertise',
    ];
}
