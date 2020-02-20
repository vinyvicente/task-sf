<?php

namespace App\Tests\Features;

use App\Tests\FeatureTestCase;

class CreateTaskTest extends FeatureTestCase
{
    public function testCreateTask()
    {
        $client = static::createClient();
        $client->request('POST', '/api/tasks', [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":"Fabien make a framework, to new version"}');

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testCreateTaskWithValidation()
    {
        $client = static::createClient();
        $client->request('POST', '/api/tasks', [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":"Fab"}');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testCreateTaskWithEmptyJson()
    {
        $client = static::createClient();
        $client->request('POST', '/api/tasks', [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{}');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
