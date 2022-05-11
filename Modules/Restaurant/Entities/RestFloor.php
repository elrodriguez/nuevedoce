<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestFloor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'state'];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\RestFloorFactory::new();
    }
}
