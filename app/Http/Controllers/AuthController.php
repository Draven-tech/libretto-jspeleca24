<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $user = Auth::user();
        $token = $user->createToken('api-token', ['*'], now()->addDay())->plainTextToken;
        
        $user->forceFill([
            'api_token_expires_at' => now()->addDay()
        ])->save();
        
        return response()->json([
            'token' => $token,
            'expires_at' => now()->addDay()->toDateTimeString()
        ]);
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->forceFill([
            'api_token_expires_at' => null
        ])->save();
        
        return response()->json(['message' => 'Logged out']);
    }
}