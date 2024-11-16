<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\LogService;
class Import_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'supplier_id',
        'slug',
        'status',
        'cancel_reason',
        'total_amount',
        'paid_amount',
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function importOrderDetails(){
        return $this->hasMany(Import_order_detail::class);
    }
    public function newOrderRequests()
    {
        return $this->hasMany(NewOrderRequest::class, 'import_order_id');
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
