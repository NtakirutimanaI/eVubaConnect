<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentEmail extends Model
{
    protected $fillable = ['to_email', 'subject', 'body', 'attachments'];

    protected $casts = [
        'attachments' => 'array',
    ];
}
