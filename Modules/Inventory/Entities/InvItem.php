<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'part',
        'weight',
        'width',
        'high',
        'long',
        'purchase_price',
        'sale_price',
        'number_parts',
        'status',
        'brand_id',
        'category_id',
        'unit_measure_id',
        'person_create',
        'person_edit',
        'model_id',
        'has_plastic_bag_taxes',
        'stock_min',
        'unit_measure_id',
        'currency_type_id',
        'digemid',
        'sale_affectation_igv_type_id',
        'item_type_id',
        'stock',
        'unit_type_id',
        'internal_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvItemFactory::new();
    }
}
