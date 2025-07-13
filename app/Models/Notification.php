<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'message',
        'client_id',
        'sent_at',
    ];

    protected $dates = ['sent_at'];

    // Relationship to Client (optional)
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
