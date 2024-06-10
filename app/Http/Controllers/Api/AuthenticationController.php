<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WeatherController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthenticationController extends Controller
{

    /**
     * Handle an incoming authentication request.
     */
    public function token()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            // successfull authentication
            $user = User::find(Auth::user()->id);

            $user_token = $user->createToken('appToken')->accessToken->token;
            $hashedToken = hash('sha256', $user_token);

            $user->token = $hashedToken;
            $user->save();

            return response()->json([
                'success' => true,
                'token' => $user->name.'_'.$user_token,
            ], 200);
        } else {
            // failure to authenticate
            return response()->json([
                'success' => false,
                'message' => 'Failed to authenticate.',
            ], 401);
        }
    }
}
