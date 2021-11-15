<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvModel extends Model
{
    use HasFactory;

    protected $fillable = ['description'];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvModelFactory::new();
    }
}
