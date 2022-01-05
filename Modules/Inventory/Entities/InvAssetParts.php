<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvAssetParts extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'asset_part_id',
        'state'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvAssetPartsFactory::new();
    }
}
