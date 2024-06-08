<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomAuthUserRoleController extends ApiController
{
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|max:6|confirmed',
        ]);

        $credentials['password'] = bcrypt($credentials['password']);

        $user = User::create($credentials);

        $token = $user->createToken('auth_token')->plainTextToken;

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->successResponse(['token' => $token]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'The credentials do not match our records!'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse(['token' => $token]);
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
