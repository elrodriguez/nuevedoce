<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalSaleNote extends Model
{
    use HasFactory;

    protected $with = ['user', 'soap_type', 'state_type', 'currency_type', 'items', 'payments'];

    protected $fillable = [
        'user_id',
        'external_id',
        'establishment_id',
        'establishment',
        'soap_type_id',
        'state_type_id',
        'prefix',
        'series',
        'number',
        'date_of_issue',
        'time_of_issue',
        'customer_id',
        'customer',
        'currency_type_id',
        'payment_method_type_id',
        'exchange_rate_sale',
        'apply_concurrency',
        'enabled_concurrency',
        'automatic_date_of_issue',
        'quantity_period',
        'type_period',
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
        'filename',
        'order_note_id',
        'total_canceled',
        'changed',
        'paid',
        'license_plate',
        'plate_number',
        'reference_data',
        'observation',
        'purchase_order',
        'document_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalSaleNoteFactory::new();
    }

    protected $casts = [
        'date_of_issue' => 'date',
        'automatic_date_of_issue' => 'date',
    ];

    public function getEstablishmentAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setEstablishmentAttribute($value)
    {
        $this->attributes['establishment'] = (is_null($value))?null:json_encode($value);
    }

    public function getCustomerAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setCustomerAttribute($value)
    {
        $this->attributes['customer'] = (is_null($value))?null:json_encode($value);
    }

    public function getChargesAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setChargesAttribute($value)
    {
        $this->attributes['charges'] = (is_null($value))?null:json_encode($value);
    }

    public function getDiscountsAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setDiscountsAttribute($value)
    {
        $this->attributes['discounts'] = (is_null($value))?null:json_encode($value);
    }

    public function getPrepaymentsAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setPrepaymentsAttribute($value)
    {
        $this->attributes['prepayments'] = (is_null($value))?null:json_encode($value);
    }

    public function getGuidesAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setGuidesAttribute($value)
    {
        $this->attributes['guides'] = (is_null($value))?null:json_encode($value);
    }

    public function getRelatedAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setRelatedAttribute($value)
    {
        $this->attributes['related'] = (is_null($value))?null:json_encode($value);
    }

    public function getPerceptionAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setPerceptionAttribute($value)
    {
        $this->attributes['perception'] = (is_null($value))?null:json_encode($value);
    }

    public function getDetractionAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setDetractionAttribute($value)
    {
        $this->attributes['detraction'] = (is_null($value))?null:json_encode($value);
    }

    public function getLegendsAttribute($value)
    {
        return (is_null($value))?null:(object) json_decode($value);
    }

    public function setLegendsAttribute($value)
    {
        $this->attributes['legends'] = (is_null($value))?null:json_encode($value);
    }

    public function getIdentifierAttribute()
    {
        return $this->prefix.'-'.$this->id;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function soap_type()
    {
        return $this->belongsTo(\App\Models\SoapType::class);
    }

    public function establishment()
    {
        return $this->belongsTo(\Modules\Setting\Entities\SetEstablishment::class,'establishment_id');
    }

    public function state_type()
    {
        return $this->belongsTo(\App\Models\StateType::class);
    }

    public function person() {
        return $this->belongsTo(\App\Models\Person::class, 'customer_id');
    }


    public function currency_type()
    {
        return $this->belongsTo(\App\Models\CurrencyType::class, 'currency_type_id');
    }

    public function items()
    {
        return $this->hasMany(\Modules\Sales\Entities\SalSaleNoteItem::class,'sale_note_id');
    }

    // public function kardex()
    // {
    //     return $this->hasMany(\Modules\Inventory\Entities\InvKardex::class,'');
    // }


    public function payments()
    {
        return $this->hasMany(SalSaleNotePayment::class,'sale_note_id');
    }

    public function scopeWhereTypeUser($query)
    {
        $user = auth()->user();
        return ($user->type == 'seller') ? $query->where('user_id', $user->id) : null;
    }

    
    public function scopeWhereStateTypeAccepted($query)
    {
        return $query->whereIn('state_type_id', ['01','03','05','07','13']);
    }

    public function scopeWhereNotChanged($query)
    {
        return $query->where('changed', false);
    }
    

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
