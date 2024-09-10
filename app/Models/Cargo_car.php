<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo_car extends Model
{
    use HasFactory;

    public function cargoCarType()
    {
        return $this->belongsTo(Cargo_Car_Type::class, 'cargo_car_type_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'cargo_car_id');
    }
}
