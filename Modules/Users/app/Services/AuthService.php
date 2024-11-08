<?php

namespace Modules\Users\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use  Modules\Users\Models\User;

class AuthService
{
    // Attempt to log in a user with the given credentials
    public function login(array $credentials)
    {
        if (!$token = Auth::attempt($credentials)) {
            return [
                'status' => 'error',
                'message' => 'Unauthorized',
                'code' => 401,
            ];
        }


        return [
            'status' => 'success',
            'user' => Auth::user(),
            'token' => $token,
            'code' => 200,
        ];
    }


    public function logout()
    {
        Auth::logout();

        return [
            'status' => 'success',
            'message' => 'Successfully logged out',
            'code' => 200,
        ];
    }
}
