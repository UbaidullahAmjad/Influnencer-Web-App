<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ounass extends Model
{
    use HasFactory;
    protected $table = "ounass";
    protected $fillable = [
        'brand_id',
        'coupon_id',
        'orders',
        'aov_usd',
        'last_update',
        'date',
    ];
}
