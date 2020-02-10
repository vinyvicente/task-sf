<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Infrastructure\Doctrine\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository implements \App\Domain\TaskRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function create(\App\Domain\Task $task): int
    {
        // TODO: Implement create() method.
    }

    public function get($id): ?\App\Domain\Task
    {
        // TODO: Implement get() method.
    }

    public function update($id, \App\Domain\Task $task): \App\Domain\Task
    {
        // TODO: Implement update() method.
    }

    public function has($id): bool
    {
        // TODO: Implement has() method.
    }

    public function remove($id): void
    {
        // TODO: Implement remove() method.
    }
}
