<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerVehicleCrewman extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id','employee_id','description'];
    
    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerVehicleCrewmanFactory::new();
    }
}
