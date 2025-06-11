<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

/**
 * Summary of UserController
 */
class UserController extends Controller
{
    /**
     * User service instance
     * @var
     */
    private $service;

    /**
     * Create user controller instance
     *
     * @param UserService $service User service instance
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * User registration
     *
     * @param StoreUserRequest $request Request instance
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        return $this->service->create($request->input('data.attributes'));
    }
}
