<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWifiData extends Model
{
    protected $table = 'user_wifi_data';
    protected $fillable = [
        'wifi_name',
        'ssid',
        'ip',
        'gateway',
    ];
}
