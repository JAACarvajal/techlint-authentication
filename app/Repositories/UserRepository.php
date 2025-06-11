<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Create user repository instance
     *
     * @param User $model User model instance
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
