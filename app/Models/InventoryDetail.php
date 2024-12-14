<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'variation_id',
        'actual_quantity',
        'system_quantity',
        'deviation',
    ];

    public $timestamps = false;

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }

}
