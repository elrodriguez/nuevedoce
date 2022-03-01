<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'soap_type_id',
        'destination_id',
        'destination_type',
        'payment_id',
        'payment_type',
        'user_id'
    ];
}
