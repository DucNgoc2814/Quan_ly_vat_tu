<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip_detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'trip_id',
        'total_amount',
    ];

    public $timestamps = false;

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function trip(){
        return $this->belongsTo(Trip::class);
    }
}
