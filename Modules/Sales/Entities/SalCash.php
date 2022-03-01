<?php

namespace Modules\Sales\Entities;

use App\Models\GlobalPayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalCash extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_opening',
        'time_opening',
        'date_closed',
        'time_closed',
        'beginning_balance',
        'final_balance',
        'income',
        'state',
        'reference_number'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Sales\Database\factories\SalCashFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    //obtiene documentos y notas venta
    public function cash_documents()
    {
        return $this->hasMany(SalCashDocument::class,'cash_id');
    }

    public function scopeWhereTypeUser($query)
    {
        $user = auth()->user();
        return ($user->type == 'seller') ? $query->where('user_id', $user->id) : null;
    }

    public function global_destination()
    {
        return $this->morphMany(GlobalPayment::class, 'destination');
    }

    public function cash_transaction()
    {
        return $this->hasOne(SalCashTransaction::class);
    }

    public function getCurrencyTypeIdAttribute()
    {
        return 'PEN';
    }

    public function getNumberFullAttribute()
    {

        if($this->cash_transaction){
            return "{$this->cash_transaction->description} - Caja chica".($this->reference_number ? ' N° '.$this->reference_number:'');
        }

        return '-';

    }
}
