<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaPersonType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'person_create',
        'person_edit',
        'state'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Staff\Database\factories\StaPersonTypeFactory::new();
    }
}
