<?php

namespace App\Models;

use Hamcrest\Type\IsBoolean;
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
        'number_phone',
        'image',
        'date',
        'is_active',
    ];

    protected $cast = [
        'is_active' => 'boolean',
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
