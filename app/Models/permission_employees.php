<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_employees extends Model
{
    use HasFactory;


    protected $fillable = [
        'permission_id',
        'employee_id',
    ];

    public $timestamps = false;
}
