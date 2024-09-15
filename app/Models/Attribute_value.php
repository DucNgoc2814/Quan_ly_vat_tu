<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute_value extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'attribute_id',
        'value',
    ];

    public $timestamps = false;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'variation_attribute_value', 'attribute_value_id', 'variation_id');
    }
}
