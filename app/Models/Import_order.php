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
        'status_id',
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

    public function orderStatus()
    {
        return $this->belongsTo(Order_status::class, 'status_id');
    }
    
    public function importOrderDetails(){
        return $this->belongsTo(Import_order_detail::class);
    }

}
