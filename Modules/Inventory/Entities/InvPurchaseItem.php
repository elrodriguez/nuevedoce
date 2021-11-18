<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvPurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'purchase_id',
        'item_id',
        'quantity',
        'price',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvPurchaseItemFactory::new();
    }
}
