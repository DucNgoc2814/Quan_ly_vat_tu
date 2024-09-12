<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import_order_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'product_id',
        'variation_id',
        'quantity',
        'price',
    ];

    public $timestamps = false;
}
