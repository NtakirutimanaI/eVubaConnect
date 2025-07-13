<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeAvailability extends Model
{
    protected $table = 'employee_availability';

    protected $fillable = [
        'employee_id',
        'available_date',
        'start_time',
        'end_time',
    ];

    // Relationship to Employee
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
