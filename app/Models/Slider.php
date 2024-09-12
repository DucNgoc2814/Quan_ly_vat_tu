<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'url_',
        'description',
        'date_start',
        'date_end',
        'status',
    ];

    public $timestamps = false;
}
