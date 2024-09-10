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
}
