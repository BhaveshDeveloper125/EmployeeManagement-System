<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraUserData extends Model
{
    protected $fillable = [
        'user_id',
        'post',
        'mobile',
        'address',
        'qualificatio',
        'exp',
        'joining_date',
        'isAdmin'
    ];
}
