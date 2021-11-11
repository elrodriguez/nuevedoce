<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvItemPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'part_id',
        'state',
        'quantity',
        'observations',
        'internal_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvItemPartFactory::new();
    }
}
