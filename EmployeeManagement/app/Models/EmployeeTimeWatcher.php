<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeTimeWatcher extends Model
{
    protected $fillable = [
        'entry',
        'leave',
        'user_id',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
