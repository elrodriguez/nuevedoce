<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatPaymentMethodType extends Model
{
    use HasFactory;
    public $incrementing = false;
    
    protected $fillable = [
        'description',
        'has_card',
        'charge',
        'number_days'
    ];
}
