<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Response;

class ControllerTestBase extends WebTestCase
{
    protected static ?AbstractBrowser $user = null;
    protected string $userId;

    public function setUp(): void
    {
        self::$user = static::createClient();

//        $admin = User::create(Uuid::random()->value(), 'admin', 'admin@api.com', 'Password1!', 18);
//        $password = static::getContainer()->get(PasswordHasherInterface::class)->hashPasswordForUser($admin, 'Password1!');
//        $admin->setPassword($password);
//        $admin->setRoles(['ROLE_ADMIN']);
//
//
//        static::getContainer()->get(UserRepositoryInterface::class)->save($admin);
//
//        $jwt = static::getContainer()->get(JWTTokenManagerInterface::class)->create($admin);
//
//        self::$admin->setServerParameters([
//            'CONTENT_TYPE' => 'application/json',
//            'HTTP_Authorization' => \sprintf('Bearer %s', $jwt)
//        ]);

//        $this->userId = $this->createUser();
    }

    protected function getResponseData(Response $response): ?array
    {
        try {
            return \json_decode($response->getContent(), true);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}