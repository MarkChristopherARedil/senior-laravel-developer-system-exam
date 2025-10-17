<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Generate user auth token.
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = User::where('email', $validated['email'])->first();

        return response()->json([
            'message' => 'Login successfully!',
            'auth_token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer'
        ], 200);
    }

    /**
     * Delete user auth token.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'logout successfully!'
        ], 200);
    }
}
