<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Styli extends Model
{
    use HasFactory;
    protected $table = "styli";
    protected $fillable = [
        'brand_id',
        'coupon_id',
        'customer_type',
        'revenue',
        'automation',
        'ad_set',
        'aov_usd',
        'last_update',
        'date',
    ];
}
