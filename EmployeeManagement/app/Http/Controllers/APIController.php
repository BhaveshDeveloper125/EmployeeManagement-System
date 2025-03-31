<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    public function SignUp()
    {
        return response()->json('Welcome and thanks for sign up');
    }
}
