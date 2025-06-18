<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function GetLeaves(Request $request)
    {
        return response()->json($request->all());
    }
}
