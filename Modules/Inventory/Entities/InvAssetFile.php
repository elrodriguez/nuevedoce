<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvAssetFile extends Model
{
    use HasFactory;

    protected $fillable = ['name','route','extension','asset_id'];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvAssetFileFactory::new();
    }
}
