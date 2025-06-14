<?php

namespace App\Services;

use App\Constants\HttpCodes;
use App\Http\Resources\V1\{AuthResource, UserResource};
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthService extends BaseService
{
    /**
     * Check if user is authenticated
     */
    public function check(): JsonResponse
    {
        $user = auth()->userOrFail();

        return self::responseSuccess(new UserResource($user), HttpCodes::OK);
    }

    /**
     * User login
     *
     * @param array $data Request data for user login
     */
    public function login(array $data): JsonResponse
    {
        $token = auth()->attempt($data);

        if (!$token) {
            throw new AuthorizationException('Invalid credentials.');
        }

        return self::responseSuccess(new AuthResource($token), HttpCodes::CREATED);
    }

    /**
     * Logout user
     */
    public function logout(): JsonResponse
    {
        request()->attributes->set('user_id', auth()->id());

        auth()->logout();

        return self::responseSuccess(
            JsonResource::make(null)->additional([
                'meta' => $this->withAuthMetadata(request())
            ]),
            HttpCodes::OK
        );
    }

    /**
     * Refresh JWT token
     */
    public function refresh(): JsonResponse
    {
        $token = auth()->refresh();

        return self::responseSuccess(new AuthResource($token), HttpCodes::CREATED);
    }
}
