<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'buying_price',
        'selling_price',
        'qty',
        'expiry_date'
    ];


    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
