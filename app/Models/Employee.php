<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject

{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'image',
        'number_phone',
        'cccd',
        'date',
        'description',
        'is_active',
        'password',
    ];

    protected $cast = [
        'is_active' => 'boolean',
    ];

    public function roleEmployee() {
        return $this->belongsTo(Role_employee::class,'role_id');
    }

    public function trips() {
        return $this->hasMany(Trip::class);
    }

    public function requests() {
        return $this->hasMany(Request::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->name,
            'role' => $this->role_id,
            'id' => $this->id,
            'is_employee' => true,
            'name' => $this->name,
            'namimage' => $this->namimage,
            'description' => $this->description
        ];
    }
}
