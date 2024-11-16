<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
class Cargo_car extends Model
{
    use HasFactory;

    protected $fillable = [
        'cargo_car_type_id',
        'license_plate',
        'is_active',
    ];

    protected $cast = [
        'is_active' => 'boolean',
    ];
    
    public $timestamps = false;

    public function cargoCarType()
    {
        return $this->belongsTo(Cargo_car_type::class);
    }

    public function trips()
    {
        return $this->hasOne(Trip::class);
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
