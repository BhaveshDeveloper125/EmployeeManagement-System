<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CustomeAuth extends Model
{
    use Notifiable;

    protected $table = 'custome_auths';

    protected $fillable = [
        'name',
        'email',
        'password',
        'post',
        'mobile',
        'address',
        'qualification',
        'experience',
        'isAdmin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
