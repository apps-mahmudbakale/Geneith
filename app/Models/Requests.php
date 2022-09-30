<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'station_id',
        'user_id',
        'product_id',
        'request_qty',
        'approved_qty',
        'request_ref'
    ];
}
