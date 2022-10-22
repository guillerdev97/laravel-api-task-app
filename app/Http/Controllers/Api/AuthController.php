<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validations = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $user = User::where('email', '=', $request->email)->first();
    }
}
