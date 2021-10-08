<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerLocal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'address',
        'reference',
        'longitude',
        'latitude',
        'person_create',
        'person_edit',
        'state'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerLocalFactory::new();
    }
}
