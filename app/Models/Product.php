<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'unit_id',
        'brand_id',
        'name',
        'price',
        'description',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'publisher_product', 'product_id', 'supplier_id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'product_id');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'product_id');
    }
}
