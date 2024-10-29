<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'username' => $this->name,
            'role' => $this->role  ,
            'id' => $this->id
        ];
    }
}
