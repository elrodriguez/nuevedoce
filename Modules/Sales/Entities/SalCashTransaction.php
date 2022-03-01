<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalCashTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_id',
        'payment_method_type_id',
        'description',
        'payment'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalCashTransactionFactory::new();
    }

    public function payment_method_type()
    {
        return $this->belongsTo(\App\Models\CatPaymentMethodTypes::class,'payment_method_type_id');
    }
}
