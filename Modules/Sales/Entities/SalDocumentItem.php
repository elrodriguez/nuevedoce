<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalDocumentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'item_id',
        'item',
        'quantity',
        'unit_value',
        'affectation_igv_type_id',
        'total_base_igv',
        'percentage_igv',
        'total_igv',
        'system_isc_type_id',
        'total_base_isc',
        'percentage_isc',
        'total_isc',
        'total_base_other_taxes',
        'percentage_other_taxes',
        'total_other_taxes',
        'total_plastic_bag_taxes',
        'total_taxes',
        'price_type_id',
        'unit_price',
        'total_value',
        'total_charge',
        'total_discount',
        'total',
        'attributes',
        'discounts',
        'charges'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalDocumentItemFactory::new();
    }

    public function document()
    {
        return $this->belongsTo(SalDocument::class, 'document_id');
    }
}
