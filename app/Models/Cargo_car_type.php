<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
class Cargo_car_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'capacity'
    ];

    public $timestamps = false;

    public function cargoCars()
    {
        return $this->hasMany(Cargo_car::class);
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
