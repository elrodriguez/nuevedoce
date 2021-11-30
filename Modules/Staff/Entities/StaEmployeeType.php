<?php

namespace Modules\Staff\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaEmployeeType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'person_create',
        'person_edit',
        'state'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Staff\Database\factories\StaEmployeeTypeFactory::new();
    }
}
