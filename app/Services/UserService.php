<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class UserService
{
    public function __construct(protected UserRepositoryInterface $userRepository) {}

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }
}
