<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * Summary of AuthController
 */
class AuthController extends Controller
{
    /**
     * Auth service instance
     * @var
     */
    private $service;

    /**
     * Create auth controller instance
     *
     * @param AuthService $service Auth service instance
     */
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * Check if user is authenticated
     */
    public function check()
    {
        try {
            auth()->userOrFail();
            return response()->json(['message' => 'Authenticated'], 200);
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * User login
     *
     * @param LoginRequest $request Request instance
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->service->login($request->input('data.attributes'));
    }

    public function logout()
    {
        return $this->service->logout();
    }

    /**
     * Refresh JWT token
     */
    public function refresh()
    {
        return $this->service->refresh();
    }
}
