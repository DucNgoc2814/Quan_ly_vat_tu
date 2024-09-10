<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'customer_id',
        'status',
        'slug',
        'customer_name',
        'email',
        'number_phone',
        'address',
        'total_amount',
        'paid_amount',
        'payable_amount',
    ];
}
