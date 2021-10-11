<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerVehicleType extends Model
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
        return \Modules\TransferService\Database\factories\SerVehicleTypeFactory::new();
    }
}
