<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewOrderRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'variation_id',
        'quantity',
    ];

    public function importOrder()
    {
        return $this->belongsTo(Import_order::class, 'import_order_id');
    }
    public function variation()
    {
        return $this->belongsTo(Variation::class, 'variation_id');
    }
}
