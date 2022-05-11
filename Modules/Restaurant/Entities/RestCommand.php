<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestCommand extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'price', 'image', 'stock', 'internal_id', 'has_igv', 'web_show'
    ];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\RestCommandFactory::new();
    }
}
