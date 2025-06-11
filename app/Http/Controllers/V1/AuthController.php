<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\{LoginUserRequest, StoreUserRequest};
use App\Services\AuthService;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\Auth;

/**
 * Summary of AuthController
 */
class AuthController extends Controller
{
    private $service;

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
     * @param LoginUserRequest $request Request instance
     */
    public function login(LoginUserRequest $request): JsonResponse
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
    /**
     * User registration
     *
     * @param StoreUserRequest $request Request instance
     */
    public function register(StoreUserRequest $request): JsonResponse
    {
        return $this->service->register($request->input('data.attributes'));
    }
}
