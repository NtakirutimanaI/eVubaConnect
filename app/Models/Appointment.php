<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Casts\TimeCast;

class Appointment extends Model
{
    // Define the database table if not default 'appointments'
    protected $table = 'appointments';

    // Allow mass assignment on these fields
    protected $fillable = [
        'client_id',
        'employee_id',
        'service_id',
        'scheduled_date',
        'start_time',
        'end_time',
        'status',
    ];

    // Cast attributes to proper data types
    protected $casts = [
        'scheduled_date' => 'date',
        'start_time' => TimeCast::class,  // Custom cast to handle TIME fields
        'end_time' => TimeCast::class,
    ];

    // Relationships

    /**
     * Appointment belongs to a Client
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Appointment belongs to an Employee
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Appointment belongs to a Service
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
