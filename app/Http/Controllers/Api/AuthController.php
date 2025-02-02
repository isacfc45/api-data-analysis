<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterUserRequest $request)
    {
        $user = $this->authService->register($request->validated());
        return ApiResponse::success($user, 'User registered successfully.', 201);
    }

    public function login(LoginUserRequest $request)
    {
        $token = $this->authService->login($request->validated());
        return ApiResponse::success(['token' => $token], 'User logged in successfully.', 200);
    }

    public function logout()
    {
        $this->authService->logout();
        return ApiResponse::success([], 'User logged out successfully.', 200);
    }
}
