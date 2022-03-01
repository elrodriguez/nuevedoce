<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalExpense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'expense_type_id',
        'establishment_id',
        'person_id',
        'currency_type_id',
        'external_id',
        'number',
        'date_of_issue',
        'time_of_issue',
        'supplier',
        'exchange_rate_sale',
        'total',
        'state',
        'expense_reason_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalExpenseFactory::new();
    }
}
