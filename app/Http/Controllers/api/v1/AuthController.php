<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(UserRequest $request)
    {
        try {
            $user = User::create($request->validated());

            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->success(
                'User registered successfully',
                [
                    'user' => new UserResource($user),
                    'token' => $token,
                ],
                201
            );
        } catch (\Exception $e) {
            return $this->errors(
                'Registration failed',
                ['error' => $e->getMessage()],
                500
            );
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->errors(
                    'Invalid credentials',
                    null,
                    401
                );
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->success(
                'Login successful',
                [
                    'user' => new UserResource($user),
                    'token' => $token,
                ]
            );
        } catch (\Exception $e) {
            return $this->errors(
                'Login failed',
                ['error' => $e->getMessage()],
                500
            );
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return $this->success(
                'Logged out successfully'
            );
        } catch (\Exception $e) {
            return $this->errors(
                'Logout failed',
                ['error' => $e->getMessage()],
                500
            );
        }
    }
}
