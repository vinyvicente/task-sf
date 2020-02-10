<?php

namespace App\Application\Http\Actions;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class Action
{
    protected function json($data = null, int $status = 200, array $headers = [], bool $json = false)
    {
        return new JsonResponse($data, $status, $headers, $json);
    }
}