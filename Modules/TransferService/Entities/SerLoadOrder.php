<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerLoadOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'vehicle_id',
        'charge_maximum',
        'charge_weight',
        'upload_date',
        'charging_time',
        'departure_date',
        'departure_time',
        'return_date',
        'return_time',
        'additional_information',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerLoadOrderFactory::new();
    }
}
