<?php

namespace App\Application;

use App\Domain\Task;
use App\Domain\TaskRepository;
use App\Domain\UserRepository;

class TaskHandler
{
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(string $title, int $userId)
    {
        $task = new Task($title, $userId);

        return $this->repository->create($task);
    }

    public function update(int $id, string $title, int $userId)
    {
        $task = new Task($title, $userId);
        if ($this->repository->has($id)) {
            return $this->repository->update($id, $task);
        }

        return $this->repository->create($task);
    }

    public function delete(int $id): void
    {
        if ($this->repository->has($id)) {
            $this->repository->remove($id);
        }
    }

    public function get(int $id): ?Task
    {
        return $this->repository->get($id);
    }
}
