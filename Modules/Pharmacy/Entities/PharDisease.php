<?php

namespace Modules\Pharmacy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharDisease extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'causes',
        'fracture'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Pharmacy\Database\factories\PharDiseaseFactory::new();
    }
}
