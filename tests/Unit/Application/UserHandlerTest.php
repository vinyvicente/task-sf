<?php

namespace App\Tests\Application;

use App\Application\UserHandler;
use App\Domain\Task;
use App\Domain\User;
use App\Infrastructure\InMemory\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class UserHandlerTest extends TestCase
{
    private UserHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new UserHandler(new InMemoryUserRepository());
    }

    public function testUserScenario()
    {
        $this->assertEquals(1, $this->handler->createUser('Jane Doe'));
        $this->assertInstanceOf(User::class, $user = $this->handler->retrieve(1));

        $user->add(new Task('My New Task'));
        $user->add(new Task('My New Task 2'));
        $user->add(new Task('My New Task 3'));

        $this->assertEquals(3, $user->quantityTasks());
        $this->assertIsArray($user->getTasks());
        $this->assertInstanceOf(Task::class, $user->getTask(1));

        $user->removeTask(1);

        $this->assertEquals(2, $user->quantityTasks());
    }
}
