<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_employee extends Model
{
    use HasFactory;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role_employees', 'role_employee_id', 'permisson_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'role_id');
    }

}
