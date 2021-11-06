<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type_id',
        'date_of_issue',
        'serie',
        'number',
        'total'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvPurchaseFactory::new();
    }
}
