<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
class Debt extends Model
{
    use HasFactory;

    protected $fillable = [
        'debt_type_id',
        'order_id'
    ];

    public $timestamps = false;

    public function debtType(){
        return $this->belongsTo(Debt_type::class);
    }

    public function paymentHistories(){
        return $this->hasMany(Payment_history::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
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
