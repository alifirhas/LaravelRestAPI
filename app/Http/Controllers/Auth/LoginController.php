<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        //validasi data
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);

        //cek user
        $user = User::where('email', $request->email)->first();
    
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'massage' => 'Bad Credentials'
            ], 401);
        }

        //buat token untuk user
        $token = $user->createToken("myAppToken")->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
}
