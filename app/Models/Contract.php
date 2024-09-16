<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'contract_status_id',
        'contract_type_id',
        'oder_id',
        'name',
        'file',
        'note',
    ];

    public function contractStatus()
    {
        return $this->belongsTo(Contract_Status::class);
    }

    public function contractType()
    {
        return $this->belongsTo(Contract_Type::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
