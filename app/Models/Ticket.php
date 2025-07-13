<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    // Table name (optional if Laravel pluralization works)
    protected $table = 'tickets';

    // Mass assignable attributes
    protected $fillable = [
        'customer_id',
        'assigned_to',
        'subject',
        'description',
        'status',
    ];

    // Cast 'status' as enum (string)
    protected $casts = [
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define constants for status options
    public const STATUS_OPEN = 'Open';
    public const STATUS_IN_PROGRESS = 'In Progress';
    public const STATUS_RESOLVED = 'Resolved';
    public const STATUS_CLOSED = 'Closed';

    // Optional: scope for filtering by status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Relationships (optional but recommended):

    // Customer relationship (assuming Customer model exists)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Assigned User relationship (assuming User model exists)
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
