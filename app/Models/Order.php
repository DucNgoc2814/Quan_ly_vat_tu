<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'customer_id',
        'status_id',
        'contract_id',
        'employee_id',
        'slug',
        'customer_name',
        'email',
        'number_phone',
        'province',
        'district',
        'ward',
        'address',
        'total_amount',
        'paid_amount',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(Order_status::class, 'status_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function debts()
    {
        return $this->hasMany(Debt::class);
    }

    public function orderCanceled()
    {
        return $this->hasOne(Order_canceled::class);
    }
    public function orderStatusTimes()
    {
        return $this->hasMany(OrderStatusTime::class);
    }
    public function tripDetail()
    {
        return $this->hasOne(Trip_detail::class);
    }

    public function paymentHistories()
    {
        return $this->hasMany(Payment_history::class, 'related_id')
            ->where('transaction_type', Payment_history::TYPE_SALE);
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
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
