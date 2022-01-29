<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerGuideDetailAssets extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = [
        'order_id','guide_id','item_id','asset_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerGuideDetailAssetsFactory::new();
    }
}
