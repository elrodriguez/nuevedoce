<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'note_type_id',
        'note_description',
        'affected_document_id',
        'data_affected_document' 
    ];
    
    public function document()
    {
        return $this->belongsTo(SalDocument::class,'document_id');
    }

    public function affected_document()
    {
        return $this->belongsTo(SalDocument::class, 'affected_document_id');
    }

    public function note_type()
    {
        return $this->belongsTo(SalNoteTypes::class, 'note_type_id');
    }

    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalNoteFactory::new();
    }
}
