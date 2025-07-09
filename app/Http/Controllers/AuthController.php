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
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
        
        $user = Auth::user();
        $expiresAt = now()->addDay();
        $token = $user->createToken('api-token', ['*'], $expiresAt)->plainTextToken;
        
        if ($request->wantsJson()) {
            return response()->json([
                'token' => $token,
                'expires_at' => $expiresAt->toDateTimeString()
            ]);
        }
        
        // For web login, redirect to home
        return redirect('/')->with('success', 'Logged in successfully');
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        $request->user()->forceFill([
            'api_token_expires_at' => null
        ])->save();
        
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logged out']);
        }
        
        // For web logout, redirect to login
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}