<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutRequest extends Model
{
    protected $table = 'checkout_requests';
    protected $fillable = ['checkout'];
}
