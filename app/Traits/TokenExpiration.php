<?php

namespace App\Traits;

trait TokenExpiration
{
    public function createExpiringToken($name = 'auth-token')
    {
        $this->tokens()->delete();
        
        $token = $this->createToken($name);
        
        $this->forceFill([
            'api_token_expires_at' => now()->addDay()
        ])->save();
        
        return $token->plainTextToken;
    }
    
    public function tokenIsExpired()
    {
        return !$this->api_token_expires_at || $this->api_token_expires_at->isPast();
    }
}