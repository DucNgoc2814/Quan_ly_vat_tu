<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation_attribute_value extends Model
{
    use HasFactory;

    protected $fillable = [
        'variation_id',
        'attribute_value_id',
    ];
}
