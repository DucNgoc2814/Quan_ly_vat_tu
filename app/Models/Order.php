<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'customer_id',
        'status_id',
        'slug',
        'customer_name',
        'email',
        'number_phone',
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
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderStatus()
    {
        return $this->belongsTo(Order_status::class, 'status_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(Order_detail::class, 'order_id');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'order_id');
    }

    public function debts()
    {
        return $this->hasMany(Debt::class, 'order_id');
    }
}
