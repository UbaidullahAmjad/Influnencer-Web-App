<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseInformation extends Model
{
    protected $table = 'database_information';
    use HasFactory;
    protected $fillable = ['name', 'status', 'database_storage_name'];
}
