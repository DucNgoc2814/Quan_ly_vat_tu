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
        'contract_number',
        'customer_name',
        'customer_email',
        'total_amount',
        'number_phone',
        'file'
    ];

    public function contractStatus()
    {
        return $this->belongsTo(Contract_status::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'order_id');
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
