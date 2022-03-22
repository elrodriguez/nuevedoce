<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalSummaryDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'summary_id',
        'document_id',
        'description'
    ];

    public function document()
    {
        return $this->belongsTo(\Modules\Sales\Entities\SalDocument::class,'document_id');
    }

    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalSummaryDocumentFactory::new();
    }
}
