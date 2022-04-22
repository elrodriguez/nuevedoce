<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvTransaction extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'description',
        'type'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Inventory\Database\factories\InvTransactionFactory::new();
    }
}
