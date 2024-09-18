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
        return $this->belongsTo(Product::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function importOrderDetails(){
        return $this->hasMany(Import_order_detail::class);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(Attribute_value::class);
    }
}
