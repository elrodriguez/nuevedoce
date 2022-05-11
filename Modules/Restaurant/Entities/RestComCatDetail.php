<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestComCatDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'command_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\RestComCatDetailFactory::new();
    }
}
