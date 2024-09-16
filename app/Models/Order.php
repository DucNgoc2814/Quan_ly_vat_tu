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
        'payable_amount',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function status()
    {
        return $this->belongsTo(Order_Status::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(Order_Detail::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function debts()
    {
        return $this->hasMany(Debt::class);
    }
}
