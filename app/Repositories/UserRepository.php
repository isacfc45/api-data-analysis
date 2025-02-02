<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected User $user) {}

    public function all()
    {
        return $this->user->all();
    }
}
