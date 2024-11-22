<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_status_id',
        'contract_name',
        'customer_name',
        'customer_phone',
        'customer_email',
        'file',
        'timestart',
        'timeend',
        'verification_token'
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function contractStatus()
    {
        return $this->belongsTo(Contract_status::class);
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
