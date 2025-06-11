<?php

namespace App\Services;

use App\Constants\HttpCodes;
use App\Http\Resources\V1\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Summary of IpAddressService
 */
class AuthService extends BaseService
{
    /**
     * Repository instance
     * @var
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
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

            return self::responseSuccess(['token' => $token], HttpCodes::CREATED);
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

            return self::responseSuccess(['token' => $token], HttpCodes::OK);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return self::responseError('Token has expired and can no longer be refreshed', HttpCodes::UNAUTHORIZED);
        }catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return self::responseError('Failed to refresh token');
        } catch (\Exception $e) {
            return self::handleException($e);
        }
    }

    /**
     * User registration
     *
     * @param array $data Required data for user registration
     */
    public function register(array $data): JsonResponse
    {
        try {
            $user = DB::transaction(function () use ($data) {
                return $this->repository->create($data);
            });

            return self::responseSuccess(new UserResource($user), HttpCodes::CREATED);
        } catch (\Illuminate\Database\QueryException $e) {
            return self::handleException($e);
        } catch (\Exception $e) {
            return self::handleException($e);
        }
    }
}
