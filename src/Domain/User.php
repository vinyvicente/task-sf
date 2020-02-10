<?php

namespace App\Domain;

class User
{
    private string $name;
    private array $tasks;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->tasks = [];
    }

    public function quantityTasks(): int
    {
        return count($this->tasks);
    }

    public function add(Task $task)
    {
        $this->tasks[] = $task;
    }

    public function getTasks(): array
    {
        return $this->tasks;
    }

    public function getTask(int $index): Task
    {
        return $this->tasks[$index];
    }

    public function removeTask(int $index): void
    {
        unset($this->tasks[$index]);
    }
}
