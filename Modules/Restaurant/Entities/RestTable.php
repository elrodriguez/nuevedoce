<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor_id',
        'name',
        'description',
        'chairs',
        'occupied',
        'active'
    ];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\RestTableFactory::new();
    }
}
