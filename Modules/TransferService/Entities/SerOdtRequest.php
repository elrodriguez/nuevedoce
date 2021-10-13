<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerOdtRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'supervisor_id',
        'customer_id',
        'local_id',
        'wholesaler_id',
        'event_date',
        'transfer_date',
        'pick_up_date',
        'application_date',
        'description',
        'additional_information',
        'file',
        'person_create',
        'person_edit',
        'state'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerOdtRequestFactory::new();
    }
}
