<?php

namespace App\Tests;

use App\Infrastructure\Doctrine\DataFixtures\UserFixtures;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser as APIClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeatureTestCase extends WebTestCase
{
    protected APIClient $client;
    protected bool $authenticated = false;

    protected function setUp(): void
    {
        $this->resetDatabase();
        $this->client = static::createClient();
        $this->authenticate();
    }

    protected function authenticate(): void
    {
        if ($this->authenticated) {
            return ;
        }

        $this->client->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => 'vinicius',
                'password' => 'p2ss2w0rd',
            ]),
        );

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));
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

            $user = new UserFixtures(self::bootKernel()->getContainer()->get('security.password_encoder'));
            $user->load($em);
        }

        self::ensureKernelShutdown();
    }
}
