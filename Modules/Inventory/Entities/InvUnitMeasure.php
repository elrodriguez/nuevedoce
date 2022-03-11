<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvUnitMeasure extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = [
        'id','name','abbreviation','state','person_create','person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvUnitMeasureFactory::new();
    }
}
