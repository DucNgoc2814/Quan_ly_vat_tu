<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'cargo_car_id',
        'employee_id',
        'status'
    ];

    public function cargoCar()
    {
        return $this->belongsTo(Cargo_car::class);
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function tripDetail() {
        return $this->belongsTo(Trip_detail::class);
    }

    public function request() {
        return $this->belongsTo(Request::class);
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
