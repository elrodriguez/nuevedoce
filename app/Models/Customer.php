<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'direct',
        'person_create',
        'person_edit',
        'photo',
        'state'
    ];
}
