<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'email',
        'tradename',
        'logo',
        'logo_store',
        'phone',
        'phone_mobile',
        'representative_name',
        'representative_number',
        'main'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Setting\Database\factories\SetCompanyFactory::new();
    }
}
