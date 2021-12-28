<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerNoteOccurrence extends Model
{
    use HasFactory;
    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'year_created',
        'person_create',
        'person_edit',
        'load_order_id',
        'additional_information'
    ];
    
    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerNoteOccurrenceFactory::new();
    }
}
