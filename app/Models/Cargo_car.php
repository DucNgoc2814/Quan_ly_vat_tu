<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo_car extends Model
{
    use HasFactory;

protected $fillable = [
    'cargo_car_type_id',
    'license_plate',
    'is_active',
];
}
