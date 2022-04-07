<?php

namespace Modules\Pharmacy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharProductRelated extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id','keyword','description'
    ];
    
    public function item()
    {
        return $this->belongsTo(\Modules\Inventory\Entities\InvItem::class,'item_id');
    }

    public function details()
    {
        return $this->hasMany(PharProductRelatedDetail::class,'product_related_id');
    }

    protected static function newFactory()
    {
        return \Modules\Pharmacy\Database\factories\PharProductRelatedFactory::new();
    }
}
