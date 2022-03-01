<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalInvoice extends Model
{
    use HasFactory;

    protected $fillable = ['document_id','operation_type_id','date_of_due'];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalInvoiceFactory::new();
    }
}
