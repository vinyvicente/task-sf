<?php

namespace App\Tests\Features;

use App\Tests\FeatureTestCase;

class CreateTaskTest extends FeatureTestCase
{
    public function testCreateTaskWithoutAuth()
    {
        $this->client->request(
            'POST',
            '/api/tasks',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":"Fabien make a framework, to new version"}'
        );

        $this->assertEquals(401, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateTask()
    {
        $this->client->request(
            'POST',
            '/api/tasks',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":"Fabien make a framework, to new version"}'
        );

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateTaskWithValidation()
    {
        $this->client->request(
            'POST',
            '/api/tasks',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":"Fab"}'
        );

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    public function testCreateTaskWithEmptyJson()
    {
        $this->client->request(
            'POST',
            '/api/tasks',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{}'
        );

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }
}
