<?php

namespace App\Infrastructure\InMemory;

abstract class InMemoryRepository
{
    protected array $storage = [];
    protected int $increment = 0;
}
