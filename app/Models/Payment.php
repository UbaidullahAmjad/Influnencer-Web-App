<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "influencer_payments";
    use HasFactory;
    protected $fillable = [
        
        'influencer_id',
        'paypal_email',
        'wallet_id',
        'bank_name',
        'bank_account_no',
        'account_holder',
        'iban'
       
    ];
}
