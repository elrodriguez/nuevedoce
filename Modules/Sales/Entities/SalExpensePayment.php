<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalExpensePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id',
        'date_of_payment',
        'expense_method_type_id',
        'has_card',
        'reference',
        'payment'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalExpensePaymentFactory::new();
    }
}
