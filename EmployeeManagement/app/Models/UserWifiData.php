<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWifiData extends Model
{
    protected $table = 'user_wifi_data';
    protected $fillable = [
        'wifiName',
        'BSSID',
        'ipv4',
        'ipv6',
        'broadcast',
        'gateway',
        'submask',
    ];
}
