<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetTime extends Model
{
    protected $fillable = [
        'from',
        'to',
    ];
}
