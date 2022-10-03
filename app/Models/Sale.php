<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

class Sale extends Model implements AuditableInterface
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'invoice',
        'product_id',
        'qty',
        'amount',
        'station_id',
        'user_id'
    ];
}
