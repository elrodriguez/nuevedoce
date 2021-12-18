<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'loadorder_id',
        'name_document',
        'serie',
        'guide_type',
        'number',
        'date_of_issue',
        'addressee',
        'document_number',
        'shipping_type',
        'shipping_date',
        'total_gross_weight',
        'number_of_packages',
        'starting_point',
        'arrival_point',
        'type_of_transport',
        'license_plate',
        'carrier',
        'document_carrier',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerGuideFactory::new();
    }
}
