<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;

class Contract extends Model
{
    use HasFactory;
    
    // Thêm các constant cho trạng thái
    const STATUS_PENDING = 1;        // Chờ xử lý
    const STATUS_CONFIRMED = 2;      // Đã xác nhận
    const STATUS_CANCELLED = 3;      // Đã hủy
    const STATUS_WAITING_MANAGER = 4; // Chờ giám đốc
    const STATUS_WAITING_CUSTOMER = 5; // Chờ khách hàng
    const STATUS_IN_PROGRESS = 6;     // Đang tiến hành
    const STATUS_CUSTOMER_REJECTED = 7; // Khách hàng từ chối
    const STATUS_COMPLETED = 8;       // Hoàn thành
    const STATUS_EXPIRED = 9;         // Quá hạn

    protected $fillable = [
        'employee_id',
        'contract_status_id',
        'customer_id',
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

    // Thêm scope để kiểm tra trạng thái
    public function scopeInProgress($query)
    {
        return $query->where('contract_status_id', self::STATUS_IN_PROGRESS);
    }

    public function isCompleted()
    {
        return $this->contract_status_id === self::STATUS_COMPLETED;
    }

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
        return $this->belongsTo(Employee::class);
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
