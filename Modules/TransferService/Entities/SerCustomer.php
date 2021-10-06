<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'direct',
        'person_create',
        'person_edit',
        'photo',
        'state'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerCustomerFactory::new();
    }
}
