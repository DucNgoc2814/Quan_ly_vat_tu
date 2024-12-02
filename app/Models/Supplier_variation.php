<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_variation extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'variation_id',
    ];

    public $timestamps = false;
}
