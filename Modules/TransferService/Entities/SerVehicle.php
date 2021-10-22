<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_type_id',
        'license_plate',
        'mark',
        'model',
        'year',
        'length',
        'width',
        'high',
        'color',
        'features',
        'tare_weight',
        'net_weight',
        'gross_weight',
        'person_create',
        'person_edit',
        'state'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerVehicleFactory::new();
    }
}
