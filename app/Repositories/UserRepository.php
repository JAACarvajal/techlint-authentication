<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Summary of IpAddressRepository
 */
class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
