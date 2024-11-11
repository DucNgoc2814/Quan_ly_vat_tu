<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'unit_id',
        'brand_id',
        'slug',
        'name',
        'image',
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

    protected static function booted()
    {
        static::created(function ($model) {
            $result = LogService::addLog('Tạo mới', $model);
        });

        static::updated(function ($model) {
            LogService::addLog('Cập nhật', $model);
        });

        static::deleted(function ($model) {
            LogService::addLog('Xóa', $model);
        });
    }

}
