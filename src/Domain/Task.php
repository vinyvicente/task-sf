<?php

namespace App\Domain;

class Task
{
    private string $title;
    private int $userId;

    public function __construct(string $title, int $userId)
    {
        $this->title = $title;
        $this->userId = $userId;
    }

    public function toArray(): array
    {
        return ['title' => $this->title, 'user_id' => $this->userId,];
    }
}
