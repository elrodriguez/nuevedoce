<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvItemPartAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_part_id',
        'item_id',
        'asset_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvItemPartAssetFactory::new();
    }
}
