<?php

namespace App\Application;

use App\Domain\User;
use App\Domain\UserRepository;

class UserHandler
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(string $name): int
    {
        $user = new User($name);

        return $this->repository->create($user);
    }

    public function retrieve(int $id): ?User
    {
        return $this->repository->get($id);
    }
}
