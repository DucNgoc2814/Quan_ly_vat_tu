<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;

class Variation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'name',
        'stock',
        'retail_price',
        'avgImportPrice',
        'latestImportPrice',
        'is_active',
    ];

    protected $cast = [
        'is_active' => 'boolean',
    ];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function importOrderDetails()
    {
        return $this->hasMany(Import_order_detail::class);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(Attribute_value::class);
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
