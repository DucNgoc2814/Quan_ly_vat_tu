<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_history extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'amount',
        'document',
        'transaction_type',
        'related_id',
        'role',
    ];

    public $timestamps = false;

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
