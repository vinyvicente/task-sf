<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeatureTestCase extends WebTestCase
{
    protected KernelBrowser $client;

    protected function setUp(): void
    {
        $this->resetDatabase();
        $this->client = static::createClient();
    }

    private function resetDatabase(): void
    {
        /** @var EntityManagerInterface $em */
        $em = self::bootKernel()->getContainer()->get('doctrine')->getManager();

        if (!isset($metadata)) {
            $metadata = $em->getMetadataFactory()->getAllMetadata();
        }

        $schemaTool = new SchemaTool($em);
        $schemaTool->dropDatabase();

        if (!empty($metadata)) {
            $schemaTool->updateSchema($metadata);
        }

        self::ensureKernelShutdown();
    }
}
