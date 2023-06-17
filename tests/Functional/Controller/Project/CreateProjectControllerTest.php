<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Project;

use App\Entity\Client;
use App\Repository\ClientRepositoryInterface;
use App\Tests\Functional\Controller\ControllerTestBase;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateProjectControllerTest extends ControllerTestBase
{
    private const ENDPOINT = '/api/project/create';

    /**
     * @throws Exception
     */
    public function testCreateProject(): void
    {
        $payload = [
            'hatchNumber' => 'H371234',
            'name' => 'Onca Puma',
            'client' => $this->createCli()->getId(),
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('projectId', $responseData);
        self::assertEquals(36, \strlen($responseData['projectId']));
    }
}
