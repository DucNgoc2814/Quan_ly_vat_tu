<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt_type extends Model
{
    use HasFactory;

    public function debts()
    {
        return $this->hasMany(Debt::class, 'debt_type_id');
    }
}
