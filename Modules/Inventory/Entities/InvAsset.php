<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvAsset extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','part','weight','width','high','long','number_parts','status','asset_id','brand_id','category_id'];

    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvAssetFactory::new();
    }
}
