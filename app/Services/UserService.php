<?php

namespace App\Services;

use App\Constants\HttpCodes;
use App\Http\Resources\V1\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserService extends BaseService
{
    /**
     * Repository instance
     * @var
     */
    protected $repository;

    /**
     * Create user service instance
     *
     * @param UserRepository $repository User repository instance
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * User creation
     *
     * @param array $data Required data for user creation
     */
    public function create(array $data): JsonResponse
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
