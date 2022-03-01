<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectationIgvType extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = [
        'active',
        'exportation',
        'free',
        'description'
    ];
}
