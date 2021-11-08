<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvKardex extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_of_issue',
        'establishment_id',
        'item_id',
        'kardexable_id',
        'kardexable_type',
        'quantity',
        'detail'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvKardexFactory::new();
    }
}
