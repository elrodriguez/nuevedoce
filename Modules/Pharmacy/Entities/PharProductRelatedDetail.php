<?php

namespace Modules\Pharmacy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharProductRelatedDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_related_id','item_id'
    ];
    public function item()
    {
        return $this->belongsTo(\Modules\Inventory\Entities\InvItem::class,'item_id');
    }
    public function related()
    {
        return $this->belongsTo(PharProductRelated::class,'product_related_id');
    }

    protected static function newFactory()
    {
        return \Modules\Pharmacy\Database\factories\PharProductRelatedDetailFactory::new();
    }
}
