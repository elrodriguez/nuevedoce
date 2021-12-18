<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerSerie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'document_type_id',
        'serie',
        'year',
        'start_number',
        'current_number',
        'final_number',
        'number_digits',
        'state',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerSerieFactory::new();
    }
}
