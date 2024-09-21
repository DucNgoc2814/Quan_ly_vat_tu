<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'variation_id',
        'quantity',
        'price',
    ];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variations()
    {
        return $this->belongsTo(Variation::class,'variation_id');
    }
}
