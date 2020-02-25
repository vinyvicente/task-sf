<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Infrastructure\Doctrine\Entity\Task;
use App\Infrastructure\Doctrine\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository implements \App\Domain\TaskRepository
{
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);

        $this->em = $this->getEntityManager();
    }

    private function getUser(int $id): User
    {
        $repository = $this->em->getRepository(User::class);

        return $repository->find($id);
    }

    public function create(\App\Domain\Task $task): int
    {
        $taskEntity = new Task();
        $taskEntity->setTitle($task->toArray()['title']);

        $user = $this->getUser((int) $task->toArray()['user_id']);
        $taskEntity->setUser($user);

        $this->em->persist($taskEntity);
        $this->em->flush();

        return $taskEntity->getId();
    }

    public function get($id): ?\App\Domain\Task
    {
        $entity = $this->find($id);

        return new \App\Domain\Task($entity->getTitle());
    }

    public function update($id, \App\Domain\Task $task): \App\Domain\Task
    {
        $entity = $this->find($id);
        $entity->setTitle($task->toArray()['title']);

        $this->em->persist($entity);
        $this->em->flush();

        return $task;
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
