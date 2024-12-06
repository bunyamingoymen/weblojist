<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class KeyValue extends Model
{
    protected $fillable = [
        'code',
        'key',
        'value',
        'optional_1',
        'optional_2',
        'optional_3',
        'optional_4',
        'optional_5',
        'can_be_deleted',
        'delete',
        'create_user_code',
        'update_user_code'
    ];
}
