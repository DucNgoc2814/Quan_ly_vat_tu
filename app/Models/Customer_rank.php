<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_rank extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'discount',
        'amount'
    ];


    public $timestamps = false;

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
