<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function login(array $data): string
    {
        if (!Auth::attempt($data)) {
            throw new \Exception('Invalid credentials.');
        }

        return Auth::user()->createToken('auth_token')->plainTextToken;
    }

    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }
}
