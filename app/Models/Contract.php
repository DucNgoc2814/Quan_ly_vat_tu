<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'contract_status_id',
        'employee_id',
        'contract_number',
        'customer_name',
        'customer_phone',
        'customer_email',
        'total_amount',
        'file',
        'file_pdf',
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
    public function paymentHistories()
    {
        return $this->hasMany(Payment_history::class);
    }
    public function employee()
    {
        return $this->hasOne(Employee::class);
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
    public function contractDetails()
    {
        return $this->hasMany(ContractDetail::class);
    }
}
