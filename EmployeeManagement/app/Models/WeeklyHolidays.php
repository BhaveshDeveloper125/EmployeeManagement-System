<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyHolidays extends Model
{
    protected $fillable = [
        'sun',
        'mon',
        'tue',
        'wed',
        'thurs',
        'fri',
        'satur',
    ];
}
