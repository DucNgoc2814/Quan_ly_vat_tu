<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'customer_rank_id',
        'name',
        'email',
        'password',
        'number_phone',
        'image',
        'amount',
        'is_active',
    ];

    public function customerRank()
    {
        return $this->belongsTo(Customer_rank::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
