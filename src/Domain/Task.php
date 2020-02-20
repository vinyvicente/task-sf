<?php

namespace App\Domain;

class Task
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function toArray(): array
    {
        return ['title' => $this->title];
    }
}
