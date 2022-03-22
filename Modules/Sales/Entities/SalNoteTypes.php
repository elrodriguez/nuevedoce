<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalNoteTypes extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = [
        'id','active','description','debit'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalNoteTypesFactory::new();
    }
}
