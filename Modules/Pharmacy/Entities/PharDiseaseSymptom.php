<?php

namespace Modules\Pharmacy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharDiseaseSymptom extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'disease_id',
        'symptom_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Pharmacy\Database\factories\PharDiseaseSymptomFactory::new();
    }
}
