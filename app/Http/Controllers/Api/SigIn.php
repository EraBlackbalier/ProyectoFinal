<?php

namespace App\Http\Controllers\Api;

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SigIn extends Controller
{
    public function signin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Las credenciales son incorrectas',
                401
            ]);
        }


        $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
