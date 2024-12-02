<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\LogService;
class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'number_phone',
        'address',
    ];

    public function variations()
    {
        return $this->belongsToMany(Variation::class);
    }

    public function importOrders()
    {
        return $this->hasMany(Import_order::class);
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
