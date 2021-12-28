<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerNoteOccurrenceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'ocurrence_type',
        'note_occurrence_id',
        'item_id',
        'quantity',
        'description'
    ];
    
    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerNoteOccurrenceItemFactory::new();
    }
}
