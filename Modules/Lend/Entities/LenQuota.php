<?php

namespace Modules\Lend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LenQuota extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'amount',
        'state',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\Lend\Database\factories\LenQuotaFactory::new();
    }
}
