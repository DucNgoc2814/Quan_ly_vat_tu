<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'number_phone',
        'address',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function importOrders()
    {
        return $this->hasMany(Import_Order::class);
    }
}
