<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany(Order::class, 'payment_id');
    }

    public function importOrders()
    {
        return $this->hasMany(Import_Order::class, 'payment_id');
    }
}
