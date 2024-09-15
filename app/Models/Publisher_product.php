<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher_product extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'product_id',
    ];

    public $timestamps = false;
}
