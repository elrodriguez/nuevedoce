<?php

namespace Modules\Pharmacy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharSymptom extends Model
{
    use HasFactory;

    protected $fillable = ['description'];
    
    protected static function newFactory()
    {
        return \Modules\Pharmacy\Database\factories\PharSymptomFactory::new();
    }
}
