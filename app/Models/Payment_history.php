<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_history extends Model
{
    use HasFactory;

    protected $fillable = [
        'debt_id',
        'amount',
        'created_at'
    ];

    public $timestamps = false;

    public function debt(){
        return $this->belongsTo(Debt::class);
    }
}
