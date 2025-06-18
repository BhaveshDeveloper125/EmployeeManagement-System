<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'department',
        'type',
        'from',
        'to',
        'duration',
        'reason',
        'status',
    ];
}
