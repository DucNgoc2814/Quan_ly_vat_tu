<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];

    public $timestamps = false;

    public function contracts(){
        return $this->hasMany(Contract::class);
    }
}
