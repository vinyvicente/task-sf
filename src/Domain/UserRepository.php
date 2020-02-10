<?php

namespace App\Domain;

interface UserRepository
{
    public function create(User $user): int;
    public function get(int $id): ?User;
}
