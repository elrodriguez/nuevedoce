<?php

namespace Modules\Sales\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalExpenseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id','description','total'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalExpenseItemFactory::new();
    }
}
