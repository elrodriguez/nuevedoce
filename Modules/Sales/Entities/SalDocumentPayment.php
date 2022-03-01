<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalDocumentPayment extends Model
{
    use HasFactory;

    protected $with = ['payment_method_type', 'card_brand'];
    
    protected $fillable = [
        'document_id',
        'date_of_payment',
        'payment_method_type_id',
        'has_card',
        'card_brand_id',
        'reference',
        'change',
        'payment'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalDocumentPaymentFactory::new();
    }

    protected $casts = [
        'date_of_payment' => 'date',
    ];

    public function payment_method_type()
    {
        return $this->belongsTo(\App\Models\CatPaymentMethodType::class,'payment_method_type_id','id');
    }

    public function card_brand()
    {
        return $this->belongsTo(\App\Models\EntityCard::class,'card_brand_id');
    }

    public function document()
    {
        return $this->belongsTo(SalDocument::class, 'document_id');
    }


    public function global_payment()
    {
        return $this->morphOne(\App\Models\GlobalPayment::class, 'payment');
    }

    public function associated_record_payment()
    {
        return $this->belongsTo(SalDocument::class, 'document_id');
    }

    // public function payment_file()
    // {
    //     return $this->morphOne(PaymentFile::class, 'payment');
    // }
}
