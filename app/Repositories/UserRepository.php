<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    // Example: add custom user-specific queries
    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }
}
