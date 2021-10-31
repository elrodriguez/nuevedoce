<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvAssetType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'state',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvAssetTypeFactory::new();
    }
}
