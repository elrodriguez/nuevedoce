<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'warehouse_id', 'warehouse_destination_id', 'quantity'
    ];

    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvTransferFactory::new();
    }
}
