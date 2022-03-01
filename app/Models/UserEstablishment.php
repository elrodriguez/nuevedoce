<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEstablishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','establishment_id','main'
    ];
}
