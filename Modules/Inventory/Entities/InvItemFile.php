<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvItemFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'route',
        'extension',
        'item_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvAssetFileFactory::new();
    }
}
