<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'name',
        'stock',
        'price_export',
        'description',
        'is_active',
    ];

    protected $cast = [
        'is_active' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(Attribute_Value::class, 'variation_attribute_value', 'variation_id', 'attribute_value_id');
    }

    public function orderDetail()
    {
        return $this->belongsTo(Order_detail::class, foreignKey: 'variation_id');
    }
}
