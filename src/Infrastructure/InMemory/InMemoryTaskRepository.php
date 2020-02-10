<?php

namespace App\Infrastructure\InMemory;

use App\Domain\Task;
use App\Domain\TaskRepository;

class InMemoryTaskRepository extends InMemoryRepository implements TaskRepository
{
    public function create(Task $task): int
    {
        $id = $this->increment+1;

        $this->storage[$id] = $task;

        $this->increment++;

        return $this->increment;
    }

    public function get($id): ?Task
    {
        return $this->storage[$id] ?? null;
    }

    public function update($id, Task $task): Task
    {
        $this->storage[$id] = $task;

        return $task;
    }

    public function has($id): bool
    {
        return isset($this->storage[$id]);
    }

    public function remove($id): void
    {
        unset($this->storage[$id]);
    }
}
