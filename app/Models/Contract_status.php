<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract_status extends Model
{
    use HasFactory;

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'contract_status_id');
    }
}
