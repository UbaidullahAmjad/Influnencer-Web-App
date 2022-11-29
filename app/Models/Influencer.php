<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Influencer extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'phone',
        'login_id',
        'password'
       
    ];
}
