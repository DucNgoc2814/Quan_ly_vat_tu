<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_history extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'amount',
        'document',
        'transaction_type',
        'related_id',
        'status',
        'payment_id'
    ];

    const TYPE_SALE = 'sale';
    const TYPE_CONTRACT = 'contract';
    const TYPE_PURCHASE = 'purchase';

    // Constants cho status
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    // Relationship với Contract
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'related_id')
            ->when($this->transaction_type === self::TYPE_CONTRACT);
    }

    // Relationship với Sale
    public function sale()
    {
        return $this->belongsTo(Order::class, 'related_id')
            ->when($this->transaction_type === self::TYPE_SALE);
    }

    // Relationship với Purchase
    public function purchase()
    {
        return $this->belongsTo(Import_order::class, 'related_id')
            ->when($this->transaction_type === self::TYPE_PURCHASE);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    // Accessor để lấy text của status
    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'Chờ xác nhận',
            self::STATUS_APPROVED => 'Đã xác nhận',
            self::STATUS_REJECTED => 'Từ chối',
            default => 'Không xác định'
        };
    }

    // Accessor để lấy màu của status
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'warning',
            self::STATUS_APPROVED => 'success',
            self::STATUS_REJECTED => 'danger',
            default => 'secondary'
        };
    }

    // Accessor để lấy tên loại giao dịch
    public function getTransactionTypeTextAttribute()
    {
        return match ($this->transaction_type) {
            self::TYPE_CONTRACT => 'Hợp đồng',
            self::TYPE_SALE => 'Bán hàng',
            self::TYPE_PURCHASE => 'Mua hàng',
            default => 'Không xác định'
        };
    }

    // Scope để lọc theo loại giao dịch
    public function scopeOfType($query, $type)
    {
        return $query->where('transaction_type', $type);
    }

    // Scope để lọc theo trạng thái
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope để lấy các giao dịch chờ xác nhận
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }
}
