<?php

namespace Modules\TransferService\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerLoadOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'load_order_id',
        'odt_request_detail_id',
        'odt_request_id',
        'item_id',
        'amount',
        'person_create',
        'person_edit'
    ];

    protected static function newFactory()
    {
        return \Modules\TransferService\Database\factories\SerLoadOrderDetailFactory::new();
    }
}
