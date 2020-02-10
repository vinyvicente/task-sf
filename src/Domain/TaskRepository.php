<?php

namespace App\Domain;

interface TaskRepository
{
    public function create(Task $task): int;
    public function get($id): ?Task;
    public function update($id, Task $task): Task;
    public function has($id): bool;
    public function remove($id): void;
}
