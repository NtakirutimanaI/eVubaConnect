<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceReport extends Model
{
    protected $fillable = ['employee_id', 'report_date', 'tasks_completed', 'hours_worked', 'remarks'];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
