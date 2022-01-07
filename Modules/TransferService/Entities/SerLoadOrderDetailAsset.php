<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerLoadOrderDetailAsset extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'item_id',
        'asset_id',
        'load_order_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerLoadOrderDetailAssetFactory::new();
    }
}
