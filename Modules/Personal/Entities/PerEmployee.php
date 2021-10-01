<?php

namespace Modules\Personal\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_date',
        'person_id',
        'company_id',
        'occupation_id',
        'employee_type_id',
        'cv',
        'photo',
        'state'
    ];

    protected static function newFactory()
    {
        return \Modules\Personal\Database\factories\PerEmployeeFactory::new();
    }
}
