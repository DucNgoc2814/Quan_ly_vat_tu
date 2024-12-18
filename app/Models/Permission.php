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

    public $timestamps = false;

    public function roleEmployees()
    {
        return $this->belongsToMany(Role_employee::class, 'role_employee_id');
    }
}
