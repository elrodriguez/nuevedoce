<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalSaleNoteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'active','description','debit'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalSaleNoteTypeFactory::new();
    }
}
