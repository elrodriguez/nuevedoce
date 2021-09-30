<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvBrand extends Model
{
    use HasFactory;

    protected $fillable = ['description','status'];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvBrandFactory::new();
    }
}
