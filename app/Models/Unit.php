<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\LogActivity;
use Illuminate\Support\Facades\Log;

class Unit extends Model
{
    use LogActivity;
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function booted()
    {
        parent::booted();

        static::created(function ($model) {
            Log::info('Unit created, adding to log...');
            LogService::addLog('Tạo mới', $model);
        });

        static::updated(function ($model) {
            LogService::addLog('Cập nhật', $model);
        });

        static::deleted(function ($model) {
            LogService::addLog('Xóa', $model);
        });
    }
}
