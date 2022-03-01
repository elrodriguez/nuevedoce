<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalSerie extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = [
        'id',
        'correlative',
        'establishment_id',
        'user_id',
        'document_type_id',
        'state'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalSerieFactory::new();
    }
}
