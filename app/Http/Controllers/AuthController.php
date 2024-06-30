<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Models\User;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function signup(RegisterRequest $registerRequest)
    {
        try {
            $user = $registerRequest->only([
                'email',
                'password'
            ]);
            $new_user = new User($user);
            $new_user->save();

            return LoginResource::make($new_user);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'log' => $e->getMessage()
            ], 500);
        }
    }

    public function signin(LoginRequest $loginRequest)
    {
        try {
            $credentials = $loginRequest->validated();
            if (!$token = auth('auth')->attempt($credentials, true)) {
                return response()->json(['error' => 'Kullanıcı email ya da şifre Hatalı'], 401);
            }
            $user = auth('auth')->user();

            $customClaims = ['user_id' => $user->getAuthIdentifier()];
            $token = JWTAuth::claims($customClaims)->fromUser($user);

            return response()->json([
                'user' => new LoginResource($user),
                'token' => $token
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'sign_in_error' => $e->getMessage()
            ], 500);
        }
    }

    public function me()
    {
        try {
            return response()->json([
                'data' => auth('auth')->user()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'sign_in_error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            auth('auth')->logout();

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'log' => $e->getMessage()
            ], 500);
        }
    }
}
