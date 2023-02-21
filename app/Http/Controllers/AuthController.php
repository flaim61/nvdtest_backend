<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
        ]);
    }


    public function login(LoginRequest $request)
    {
        $token = Str::random(80);
        $credentials = $request->only('email', 'password');

        $auth = Auth::attempt($credentials);

        if (!$auth) {
            Log::warning("Error login! Incorrect email or password for {$credentials['email']}");
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        $user->remember_token = $token;
        $user->save();

        return response()->json([
            'status' => 'success',
            'user' => $user->toArray(),
            'authorization' => [
                'token' => $token,
            ]
        ]);
    }
}
