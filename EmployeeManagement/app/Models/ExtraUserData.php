<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraUserData extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'post',
        'mobile',
        'address',
        'qualificatio',
        'exp',
        'joining_date',
        'isAdmin',
        'leaves',
        'unused_leaves'
    ];
}
