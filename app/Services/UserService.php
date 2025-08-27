<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Events\UserRegistered;

class UserService
{
    public function __construct(
        protected UserRepository $userRepo,
    ) {}

    public function registerUser(array $data)
    {
        $user = $this->userRepo->create($data);

        // Example: business logic after creation
        // send welcome email, dispatch event, etc.
        event(new UserRegistered($user));

        return $user;
    }
}
