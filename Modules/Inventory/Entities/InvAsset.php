<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'patrimonial_code',
        'item_id',
        'asset_type_id',
        'state',
        'person_create',
        'person_edit',
        'location_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvAssetFactory::new();
    }
}
