<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusTime extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'order_status_id', 'time'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(Order_status::class);
    }
}
