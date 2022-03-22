<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'external_id',
        'soap_type_id',
        'state_type_id',
        'summary_status_type_id',
        'ubl_version',
        'date_of_issue',
        'date_of_reference',
        'identifier',
        'filename',
        'ticket',
        'has_ticket',
        'has_cdr',
        'soap_shipping_response'
    ];

    protected $casts = [
        'date_of_issue' => 'date',
        'date_of_reference' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function soap_type()
    {
        return $this->belongsTo(\App\Models\SoapType::class);
    }

    public function state_type()
    {
        return $this->belongsTo(\App\Models\StateType::class);
    }

    public function summary_status_type()
    {
        return $this->belongsTo(SalSummaryStatusType::class,'summary_status_type_id');
    }

    public function documents()
    {
        return $this->hasMany(SalSummaryDocument::class,'summary_id');
    }

    // public function getDownloadExternalXmlAttribute()
    // {
    //     return route('tenant.download.external_id', ['model' => 'summary', 'type' => 'xml', 'external_id' => $this->external_id]);
    // }

    // public function getDownloadExternalPdfAttribute()
    // {
    //     return route('tenant.download.external_id', ['model' => 'summary', 'type' => 'pdf', 'external_id' => $this->external_id]);
    // }

    // public function getDownloadExternalCdrAttribute()
    // {
    //     return route('tenant.download.external_id', ['model' => 'summary', 'type' => 'cdr', 'external_id' => $this->external_id]);
    // }
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalSummaryFactory::new();
    }
}
