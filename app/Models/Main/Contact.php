<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'code',
        'name',
        'surname',
        'email',
        'text',
        'can_be_deleted',
        'delete',
    ];
}
