<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo_car_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'capacity'
    ];

    public $timestamps = false;

    public function cargoCars()
    {
        return $this->hasMany(Cargo_car::class);
    }
}
