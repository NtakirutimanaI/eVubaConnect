<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email','password', 'role'];

    protected $hidden = ['password'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'employee_id');
    }

    public function performanceReports()
    {
        return $this->hasMany(PerformanceReport::class, 'employee_id');
    }

    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class, 'performed_by');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'employee_id');
    }

    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
