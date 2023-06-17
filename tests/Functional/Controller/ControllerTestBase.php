<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Entity\Client;
use App\Entity\Discipline;
use App\Entity\Project;
use App\Repository\Contracts\ClientRepositoryInterface;
use App\Repository\Contracts\DisciplineRepositoryInterface;
use App\Repository\Contracts\ProjectRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Response;

class ControllerTestBase extends WebTestCase
{
    private const CREATE_CLIENT_ENDPOINT = '/api/client/create';

    protected static ?AbstractBrowser $user = null;
    protected string $userId;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

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
        self::$user->setServerParameters([
            'CONTENT_TYPE' => 'application/json',
//            'HTTP_Authorization' => \sprintf('Bearer %s', $jwt)
        ]);

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

    protected function createCli(): Client
    {
        $clientRepository = static::getContainer()->get(ClientRepositoryInterface::class);

        return $clientRepository->findOneByCode('999');
    }

    protected function createProject(): Project
    {
        $projectRepository = static::getContainer()->get(ProjectRepositoryInterface::class);

        return $projectRepository->findOneByHatchNumber('H999999');
    }

    protected function createDiscipline(): Discipline
    {
        $disciplineRepository = static::getContainer()->get(DisciplineRepositoryInterface::class);

        return $disciplineRepository->findOneByCode('999');
    }
}