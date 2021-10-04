<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'department_id',
        'province_id',
        'district_id',
        'identity_document_type_id',
        'number',
        'names',
        'last_name_father',
        'last_name_mother',
        'full_name',
        'trade_name',
        'address',
        'email',
        'telephone',
        'sex',
        'type_person_id',
        'birth_date'
    ];
}
