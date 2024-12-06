<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'title',
        'url',
        'description',
        'category',
        'price',
        'cargo_company',
        'stock',
        'time',
        'can_be_deleted',
        'active',
        'delete',
        'create_user_code',
        'update_user_code'
    ];
}
