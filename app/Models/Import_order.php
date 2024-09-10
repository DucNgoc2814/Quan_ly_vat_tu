<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'supplier_id',
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
