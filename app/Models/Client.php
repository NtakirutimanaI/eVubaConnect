<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Client extends Model
{
    use Notifiable;
    protected $fillable = ['full_name', 'email', 'phone', 'company', 'address'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
