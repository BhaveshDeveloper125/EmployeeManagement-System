<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['User Not Found...', "Success" => false]);
        } else {
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            return ['result' => $success, 'msg' => "User Registered Successfully...."];
        }
        // return response()->json($user);
    }

    public function aa()
    {
        return response()->json('hii');
    }
}
