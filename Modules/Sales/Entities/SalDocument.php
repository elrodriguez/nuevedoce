<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'external_id',
        'establishment_id',
        'establishment',
        'soap_type_id',
        'state_type_id',
        'ubl_version',
        'group_id',
        'document_type_id',
        'series',
        'number',
        'date_of_issue',
        'time_of_issue',
        'customer_id',
        'customer',
        'currency_type_id',
        'purchase_order',
        'exchange_rate_sale',
        'total_prepayment',
        'total_charge',
        'total_discount',
        'total_exportation',
        'total_free',
        'total_taxed',
        'total_unaffected',
        'total_exonerated',
        'total_igv',
        'total_base_isc',
        'total_isc',
        'total_base_other_taxes',
        'total_other_taxes',
        'total_plastic_bag_taxes',
        'total_taxes',
        'total_value',
        'total',
        'charges',
        'discounts',
        'prepayments',
        'guides',
        'related',
        'perception',
        'detraction',
        'legends',
        'additional_information',
        'filename',
        'hash',
        'qr',
        'has_xml',
        'has_pdf',
        'has_cdr',
        'send_server',
        'shipping_status',
        'sunat_shipping_status',
        'query_status',
        'data_json'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalDocumentFactory::new();
    }

    public function invoice()
    {
        return $this->hasMany(SalInvoice::class,'document_id');
    }
    public function items()
    {
        return $this->hasMany(SalDocumentItem::class,'document_id');
    }
    public function payments()
    {
        return $this->hasMany(SalDocumentPayment::class,'document_id');
    }

    public function document_type()
    {
        return $this->belongsTo(\App\Models\DocumentType::class, 'document_type_id');
    }

    public function note()
    {
        return $this->hasOne(SalNote::class,'document_id');
    }
}
