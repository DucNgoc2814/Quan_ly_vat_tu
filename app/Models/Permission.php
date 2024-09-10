<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function roleEmployees()
    {
        return $this->belongsToMany(Role_Employee::class, 'permission_role_employees', 'permisson_id', 'role_employee_id');
    }
}
