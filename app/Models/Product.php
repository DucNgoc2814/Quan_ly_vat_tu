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


    protected $cast = [
        'is_active' => 'boolean',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function importOrderDetails(){
        return $this->hasMany(Import_order_detail::class);
    }

    public function OrderDetails(){
        return $this->belongsTo(Order_detail::class);
    }
}
