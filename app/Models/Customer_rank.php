<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_rank extends Model
{
    use HasFactory;

    public function customers()
    {
        return $this->hasMany(Customer::class, 'customer_rank_id');
    }
}
