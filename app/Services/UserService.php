<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\Repositories\UserRepository;

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
