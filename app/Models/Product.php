<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'category', 'quantity', 'min_threshold', 'unit', 'price', 'supplier_id'
    ];

    // Each product belongs to one supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
