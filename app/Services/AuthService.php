<?php

namespace App\Services;

use App\Constants\HttpCodes;
use App\Http\Resources\V1\{AuthResource, UserResource};
use Illuminate\Http\JsonResponse;

class AuthService extends BaseService
{
    /**
     * Check if user is authenticated
     */
    public function check(): JsonResponse
    {
        try {
            $user = auth()->userOrFail();

            return self::responseSuccess(new UserResource($user), HttpCodes::OK);
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return self::responseError('Unauthorized', HttpCodes::UNAUTHORIZED);
        } catch (\Exception $e) {
            return self::handleException($e);
        }
    }

    /**
     * User login
     *
     * @param array $data Request data for user login
     */
    public function login(array $data): JsonResponse
    {
        try {
            $token = auth()->attempt($data);

            if (!$token) {
                return self::responseError('Unauthorized', HttpCodes::UNAUTHORIZED);
            }

            return self::responseSuccess(new AuthResource($token), HttpCodes::CREATED);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return self::responseError('Failed to create token');
        } catch (\Exception $e) {
            return self::handleException($e);
        }
    }

    /**
     * Logout user
     */
    public function logout(): JsonResponse
    {
        try {
            auth()->logout();

            return self::responseWithMessage(message: 'Successfully logged out', code: HttpCodes::NO_CONTENT);
        } catch (\Exception $e) {
            return self::handleException($e);
        }
    }

    /**
     * Refresh JWT token
     */
    public function refresh(): JsonResponse
    {
        try {
            $token = auth()->refresh();

            return self::responseSuccess(new AuthResource($token), HttpCodes::CREATED);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return self::responseError('Token has expired and can no longer be refreshed', HttpCodes::UNAUTHORIZED);
        }catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return self::responseError('Failed to refresh token');
        } catch (\Exception $e) {
            return self::handleException($e);
        }
    }
}
