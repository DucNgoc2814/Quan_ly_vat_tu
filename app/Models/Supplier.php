<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'number_phone',
        'address',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'publisher_product', 'supplier_id', 'product_id');
    }

    public function importOrders()
    {
        return $this->hasMany(Import_Order::class, 'supplier_id');
    }
}
