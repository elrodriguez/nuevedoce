<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalExpenseReason extends Model
{
    use HasFactory;

    protected $fillable = ['description'];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalExpenseReasonFactory::new();
    }
}
