<?php

namespace Modules\Lend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LenPaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
        'state',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\Lend\Database\factories\LenPaymentMethodFactory::new();
    }
}
