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

    public function status()
    {
        return $this->belongsTo(Contract_Status::class, 'contract_status_id');
    }

    public function type()
    {
        return $this->belongsTo(Contract_Type::class, 'contract_type_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'oder_id');
    }
}
