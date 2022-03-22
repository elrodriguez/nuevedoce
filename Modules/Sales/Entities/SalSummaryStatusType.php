<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalSummaryStatusType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'active',
        'description'
    ];

    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalSummaryStatusTypeFactory::new();
    }
}
