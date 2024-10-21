<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VAttribute_value_variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'variation_id',
        'attribute_value_id',
    ];

    public $timestamps = false;
}
