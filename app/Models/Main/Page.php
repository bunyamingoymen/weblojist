<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'code',
        'title',
        'url',
        'description',
        'category',
        'type',
        'can_be_deleted',
        'active',
        'delete',
        'create_user_code',
        'update_user_code'
    ];
}
