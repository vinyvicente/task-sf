<?php

namespace App\Application\Http\Actions;

use App\Application\UserHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/users", name="create_user", methods={"POST"})
 */
class CreateUser
{
    private UserHandler $handler;

    public function __invoke(Request $request)
    {
        $this->handler = new UserHandler();
    }
}
