<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{

    public function Registration(Request $request)
    {
        $SignupData = $request->all();
        $request['password'] = bcrypt($request['password']);
        $user = User::create($SignupData);

        if ($user) {
            // $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $user['name'] = $user->name;
            return ['success' => true,  'msg' => "User Registered Successfully...."];
        } else {
            return response()->json('oops something went wrong , User Details are not registered');
        }

        // return response()->json($request->all());
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['User Not Found...', "Success" => false], 401);
        } else {
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            return ['result' => $success, 'msg' => "User login Successfully...."];
        }
        // return response()->json($user);
    }

    public function aa()
    {
        return response()->json('hii');
    }
}
