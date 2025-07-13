<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'client_id',
        'employee_id',
        'service_id',
        'scheduled_date',
        'start_time',
        'end_time',
        'status',
    ];

    // Cast dates and times if needed
    protected $casts = [
        'scheduled_date' => 'date',
        'start_time' => 'time',
        'end_time' => 'time',
    ];

    // Relationships

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
