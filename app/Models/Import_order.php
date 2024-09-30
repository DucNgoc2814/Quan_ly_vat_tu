<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'supplier_id',
        'slug',
        'total_amount',
        'paid_amount',
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function importOrderDetails(){
        return $this->hasMany(Import_order_detail::class);
    }

}
