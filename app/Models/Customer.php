<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_rank_id',
        'name',
        'email',
        'password',
        'image',
        'date',
        'is_active',
    ];

    public function rank()
    {
        return $this->belongsTo(Customer_Rank::class, 'customer_rank_id');
    }

    public function locations()
    {
        return $this->hasMany(Location::class, 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
