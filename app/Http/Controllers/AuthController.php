<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginUserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

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
        return $this->service->check();
    }

    /**
     * User login
     *
     * @param LoginUserRequest $request Request instance
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        return $this->service->login($request->mappedAttributes());
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
