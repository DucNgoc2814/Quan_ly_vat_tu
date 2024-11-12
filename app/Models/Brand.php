<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
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
