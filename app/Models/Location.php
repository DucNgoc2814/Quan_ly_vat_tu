<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'email',
        'number_phone',
        'province',
        'district',
        'ward',
        'address',
        'is_active',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
