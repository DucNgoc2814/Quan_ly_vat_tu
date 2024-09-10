<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission_role_employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'permisson_id',
        'role_employee_id',
    ];
}
