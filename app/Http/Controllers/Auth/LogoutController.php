<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged Out',
        ];
    }
}
