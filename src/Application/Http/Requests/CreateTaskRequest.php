<?php

namespace App\Application\Http\Requests;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateTaskRequest
{
    private string $title;

    public function __construct(RequestStack $request, ValidatorInterface $validator)
    {
        $params = json_decode($request->getCurrentRequest()->getContent(), true);

        $constraint = new Assert\Collection([
                'title' => new Assert\Length(['min' => 10]),
        ]);

        $violations = $validator->validate($params, $constraint);

        if ($violations->count()) {
            throw new InvalidArgumentException($violations->get(0)->getMessage(), 400);
        }

        $this->title = $params['title'];
    }

    public function get()
    {
        return $this->title;
    }
}
