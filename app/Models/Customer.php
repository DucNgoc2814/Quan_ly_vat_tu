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
}
