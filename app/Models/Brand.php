<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'is_active'
    ];
    protected $cast = [
        'is_active' => 'boolean'
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
