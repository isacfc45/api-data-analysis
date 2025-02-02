<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    public function __construct(protected AuthService $authService) {}

    /**
     * Registrar um novo usuário.
     *
     * @group Autenticação
     * Endpoint para registrar um novo usuário.
     *
     * @bodyParam name string required Nome do usuário. Exemplo: João Silva
     * @bodyParam email string required E-mail do usuário. Exemplo: joao@example.com
     * @bodyParam password string required Senha do usuário. Exemplo: password123
     * @bodyParam password_confirmation string required Confirmação da senha. Exemplo: password123
     * @response 201 {
     *   "user": {
     *     "id": 1,
     *     "name": "João Silva",
     *     "email": "joao@example.com",
     *     "created_at": "2023-10-01T12:00:00.000000Z",
     *     "updated_at": "2023-10-01T12:00:00.000000Z"
     *   }
     * }
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        return response()->json(['user' => $user], 201);
    }

    /**
     * Fazer login.
     *
     * @group Autenticação
     * Endpoint para fazer login e obter um token de autenticação.
     *
     * @bodyParam email string required E-mail do usuário. Exemplo: joao@example.com
     * @bodyParam password string required Senha do usuário. Exemplo: password123
     * @response {
     *   "token": "1|XyZ123..."
     * }
     * @response 401 {
     *   "message": "Invalid credentials"
     * }
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $token = $this->authService->login($request->validated());
        return response()->json(['token' => $token]);
    }

    /**
     * Fazer logout.
     *
     * @group Autenticação
     * Endpoint para fazer logout e revogar o token de autenticação.
     *
     * @authenticated
     * @response {
     *   "message": "Logged out successfully"
     * }
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
