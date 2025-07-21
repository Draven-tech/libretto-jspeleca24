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
        
        // Check for existing valid token
        $existingToken = $user->tokens()
            ->where('expires_at', '>', now())
            ->latest()
            ->first();
    
        if ($existingToken) {
            $plainTextToken = $user->api_token;
            
            return response()->json([
                'message' => 'Already logged in',
                'token' => $plainTextToken,
                'expires_at' => $existingToken->expires_at->toDateTimeString(),
            ]);
        }
    
        // Create new token if none exists
        $expiresAt = now()->addDay();
        $tokenResult = $user->createToken('api-token', ['*'], $expiresAt);
        $plainTextToken = $tokenResult->plainTextToken;
    
        // Store plain-text token in database (development only)
        $user->forceFill([
            'api_token' => $plainTextToken,
            'api_token_expires_at' => $expiresAt
        ])->save();
    
        return response()->json([
            'token' => $plainTextToken,
            'expires_at' => $expiresAt->toDateTimeString(),
            'message' => 'Login successful'
        ]);
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}