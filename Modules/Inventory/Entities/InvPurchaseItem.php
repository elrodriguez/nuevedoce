<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvPurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'item_id',
        'quantity'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvPurchaseItemFactory::new();
    }
}
