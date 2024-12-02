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
        'customer_id',
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
        'verification_token',
        'reject_reason',
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
        return $this->hasMany(Payment_history::class, 'related_id')
            ->where('transaction_type', Payment_history::TYPE_CONTRACT);
    }
    public function employee()
    {
        return $this->hasOne(Employee::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
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
