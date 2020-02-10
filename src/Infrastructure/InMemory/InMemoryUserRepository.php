<?php

namespace App\Infrastructure\InMemory;

use App\Domain\User;
use App\Domain\UserRepository;

class InMemoryUserRepository extends InMemoryRepository implements UserRepository
{
    public function create(User $user): int
    {
        $id = $this->increment+1;

        $this->storage[$id] = $user;

        $this->increment++;

        return $this->increment;
    }

    public function get(int $id): ?User
    {
        return $this->storage[$id] ?? null;
    }
}
