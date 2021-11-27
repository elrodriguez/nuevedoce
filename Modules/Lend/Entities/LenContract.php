<?php

namespace Modules\Lend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LenContract extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'customer_id',
        'referred_id',
        'interest_id',
        'payment_method_id',
        'quota_id',
        'date_start',
        'date_end',
        'penalty',
        'amount_penalty_day',
        'amount_capital',
        'amount_interest',
        'amount_total',
        'additional_information',
        'state',
        'person_create',
        'person_edit'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Lend\Database\factories\LenContractFactory::new();
    }
}
