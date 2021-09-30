<?php

namespace Modules\Personal\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_date',
        'employee_type_id',
        'company_id',
        'activitie_id',
        'state'
    ];

    protected static function newFactory()
    {
        return \Modules\Personal\Database\factories\PerEmployeeFactory::new();
    }
}
