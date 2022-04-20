<?php

namespace Modules\Pharmacy\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'disease_id',
        'symptom_id',
        'item_id',
        'description'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Pharmacy\Database\factories\PharMedicineFactory::new();
    }
}
