<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['name', 'category', 'quantity', 'threshold', 'location'];

    public function logs()
    {
        return $this->hasMany(InventoryLog::class);
    }
}
