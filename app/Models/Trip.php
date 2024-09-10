<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    public function cargoCar()
    {
        return $this->belongsTo(Cargo_Car::class, 'cargo_car_id');
    }
}
