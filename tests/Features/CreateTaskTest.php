<?php

namespace App\Tests\Features;

use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateTaskTest extends WebTestCase
{
    private $em;

    protected function setUp(): void
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;

        $metadata = $this->em->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($this->em);
        $schemaTool->updateSchema($metadata);
    }

    public function testCreateTask()
    {
        $client = static::createClient();
        $client->request('POST', '/api/tasks', [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"title":"Fabien make a framework, to new version"}');

        var_dump($client->getResponse()->getContent());

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
