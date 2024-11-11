<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
use Illuminate\Support\Facades\Log;

class Unit extends Model
{
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

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

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
