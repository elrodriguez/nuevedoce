<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalCashDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_id',
        'document_id',
        'sale_note_id',
        'expense_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalCashDocumentFactory::new();
    }

    public function cash()
    {
        return $this->belongsTo(SalCash::class,'cash_id');
    }

    public function document()
    {
        return $this->belongsTo(SalDocument::class);
    }

    public function sale_note()
    {
        return $this->belongsTo(SalSaleNote::class);
    }

    public function expense_payment()
    {
        return $this->belongsTo(\App\Models\CatExpenseMethodTypes::class);
    }
}
