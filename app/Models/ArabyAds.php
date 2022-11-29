<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArabyAds extends Model
{
    use HasFactory;
    protected $table = "araby_ads";
    protected $fillable = [
        'brand_id',
        'coupon_id',
        'aov',
        'sale_amount',
        'sale_amount_usd',
        'last_update',
        'date',
    ];
}
