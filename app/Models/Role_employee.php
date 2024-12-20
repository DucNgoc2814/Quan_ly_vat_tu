<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'wage',
    ];

    public $timestamps = false;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}
