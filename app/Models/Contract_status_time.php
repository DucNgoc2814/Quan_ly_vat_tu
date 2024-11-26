<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract_status_time extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_id',
        'contract_status_id',
    ];
    public function contract(){
        return $this->belongsTo(Contract::class, 'contract_id');

    }
    public function contractStatus(){
        return $this->belongsTo(Contract_status::class, 'contract_status_id');
    }
}
