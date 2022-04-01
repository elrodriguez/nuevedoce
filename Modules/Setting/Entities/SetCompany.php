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
        'main',
        'soap_type_id',
        'detraction_account',
        'soap_send_id',
        'soap_user',
        'soap_password',
        'certificate_pfx',
        'certificate_pem',
        'certificate_password'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Setting\Database\factories\SetCompanyFactory::new();
    }
}
