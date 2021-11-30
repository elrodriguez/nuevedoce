<?php

namespace Modules\Lend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LenPaymentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sequence',
        'contract_id',
        'amount_to_pay',
        'date_to_pay',
        'amount_paid',
        'payment_date',
        'capital',
        'interest',
        'additional',
        'state',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\Lend\Database\factories\LenPaymentScheduleFactory::new();
    }
}
