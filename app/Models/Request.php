<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_send',
        'employee_get',
        'title',
        'content',
    ];

    public function employeeGet(){
        return $this->belongsTo(Employee::class);
    }
}
