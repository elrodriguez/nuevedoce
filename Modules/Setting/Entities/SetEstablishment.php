<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetEstablishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class,'department_id');
    }

    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class,'province_id');
    }

    public function district()
    {
        return $this->belongsTo(\App\Models\District::class,'district_id');
    }

    public function getAddressFullAttribute()
    {
        $address = ($this->address != '-')? $this->address.' ,' : '';
        return "{$address} {$this->department->description} - {$this->province->description} - {$this->district->description}";
    }
}
