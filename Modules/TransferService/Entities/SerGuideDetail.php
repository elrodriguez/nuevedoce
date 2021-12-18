<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerGuideDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'guide_id',
        'quantity',
        'unit',
        'code',
        'description',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerGuideDetailFactory::new();
    }
}
