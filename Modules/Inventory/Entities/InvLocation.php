<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'establishment_id',
        'name',
        'state'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvLocationFactory::new();
    }
}
