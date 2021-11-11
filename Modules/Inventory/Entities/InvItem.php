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
        'number_parts',
        'status',
        'brand_id',
        'category_id',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvItemFactory::new();
    }
}
