<?php

namespace App\Tests\Application;

use App\Application\TaskHandler;
use App\Domain\Task;
use App\Infrastructure\InMemory\InMemoryTaskRepository;
use PHPUnit\Framework\TestCase;

class TaskHandlerTest extends TestCase
{
    private TaskHandler $handler;
    private int $userId = 1;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new TaskHandler(new InMemoryTaskRepository());
    }

    public function testScenario()
    {
        $task = $this->handler->create('Test Title', $this->userId);

        $this->assertEquals(1, $task);

        $taskUpdated = $this->handler->update(1, 'New Title', $this->userId);

        $this->assertInstanceOf(Task::class, $taskUpdated);
        $this->assertInstanceOf(Task::class, $this->handler->get(1));

        $this->handler->delete(1);

        $this->assertNull($this->handler->get(1));

        // trying update a task not existent
        $task = $this->handler->update(1, 'New Title', $this->userId);

        $this->assertIsInt($task);
    }
}
