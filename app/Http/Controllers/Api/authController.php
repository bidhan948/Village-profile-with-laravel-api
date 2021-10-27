<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(['email' => 'required', 'password' => 'required']);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'provided credential is incorect',
                401
            ]);
        }
        $token = $user->createToken($user->name)->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'successfully logged out'
        ]);
    }
}
