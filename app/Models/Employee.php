<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Services\LogService;
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

    public function roleEmployee()
    {
        return $this->belongsTo(Role_employee::class, 'role_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function contract()
    {
        return $this->hasMany(Contract::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getJWTCustomClaims()
    {
        return [
            'name' => $this->name,
            'role' => $this->role_id,
            'id' => $this->id,
            'is_employee' => true,
            'namimage' => $this->namimage,
            'description' => $this->description
        ];
    }

    protected static function booted()
    {
        static::created(function ($model) {
            $result = LogService::addLog('Tạo mới', $model);
        });

        static::updated(function ($model) {
            LogService::addLog('Cập nhật', $model);
        });

        static::deleted(function ($model) {
            LogService::addLog('Xóa', $model);
        });
    }

}
