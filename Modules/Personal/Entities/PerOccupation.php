<?php

namespace Modules\Personal\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerOccupation extends Model
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
        return \Modules\Personal\Database\factories\PerOccupationFactory::new();
    }
}
