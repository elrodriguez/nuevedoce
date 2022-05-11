<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestCategoryCommand extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'status',
        'category_id'
    ];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\RestCategoryCommandFactory::new();
    }
}
