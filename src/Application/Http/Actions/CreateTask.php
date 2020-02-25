<?php

namespace App\Application\Http\Actions;

use App\Application\Http\Requests\CreateTaskRequest;
use App\Application\TaskHandler;
use App\Infrastructure\Doctrine\Repository\TaskRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/api/tasks", methods={"POST"}, name="create_task")
 */
class CreateTask extends Action
{
    public function __invoke(TaskRepository $repository, CreateTaskRequest $request, UserInterface $user)
    {
        $handler = new TaskHandler($repository);

        return $this->json(['success' => (bool) $handler->create($request->get(), $user->getId())], 201);
    }
}
