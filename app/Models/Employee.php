<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'image',
        'cccd',
        'date',
        'description',
        'is_active',
    ];

    protected $cast = [
        'is_active' => 'boolean',
    ];

    public function roleEmployee() {
        return $this->belongsTo(Role_employee::class);
    }

    public function trips() {
        return $this->hasMany(Trip::class);
    }

    public function requests() {
        return $this->hasMany(Request::class);
    }
}
