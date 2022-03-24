<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetShortCut extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'name',
        'route_name',
        'role_name',
        'permission'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Setting\Database\factories\SetShortCutFactory::new();
    }
}
