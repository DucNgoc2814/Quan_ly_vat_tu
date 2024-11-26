<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_id',
        'variation_id',
        'quantity',
        'price'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function variation()
    {
        return $this->belongsTo(Variation::class);
    }
}
