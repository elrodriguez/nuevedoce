<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseMethodType extends Model
{
    use HasFactory;

    protected $fillable = [
        'description','has_card'
    ];
}
