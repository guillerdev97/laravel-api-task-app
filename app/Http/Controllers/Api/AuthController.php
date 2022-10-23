<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            // login validation
            $validations = [
                'email' => 'required|email',
                'password' => 'required'
            ];

            $validator = Validator::make(
                $request->all(),
                $validations
            );

            if ($validator->fails()) {
                $errors = $validator->errors();

                throw new Exception(
                    json_encode($errors),
                    400,
                );
            }

            // register user validation firts email second password
            $user = User::where('email', '=', $request->email)->first();

            // email
            if (isset($user->id) === true) {
                // password
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('auth_token')->plainTextToken;

                    return response()->json([
                        'status' => 1,
                        'msg' => 'User is logged in',
                        'data' => $user,
                        'access_token' => $token
                    ], 200);
                }

                throw new Exception(
                    'Invalid password',
                    400
                );
            }

            if (isset($user->id) === false) {
                throw new Exception(
                    'User not registered',
                    404
                );
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $code = $e->getCode();

            if(json_encode($e->getMessage())) {
                $msg = json_decode($e->getMessage());
            }
          
            return response()->json([
                'status' => 0,
                'msg' => $msg
            ], $code);
        }
    }
}
