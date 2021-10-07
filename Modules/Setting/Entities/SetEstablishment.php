<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetEstablishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'observation',
        'state',
        'company_id',
        'country_id',
        'department_id',
        'province_id',
        'district_id',
        'web_page',
        'email',
        'latitude',
        'longitude',
        'map'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Setting\Database\factories\SetEstablishmentFactory::new();
    }
}
