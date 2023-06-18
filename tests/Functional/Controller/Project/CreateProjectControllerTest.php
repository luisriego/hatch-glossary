<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Project;

use App\Tests\Functional\Controller\ControllerTestBase;
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


    public function testCreateProjectWithNameTooShort(): void
    {
        $payload = [
            'hatchNumber' => 'H371234',
            'name' => 'Onc',
            'client' => $this->createCli()->getId(),
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreateProjectWithNameTooLong(): void
    {
        $payload = [
            'hatchNumber' => 'H371234',
            'name' => 'A while back I needed to count the amount of letters that a piece of te',
            'client' => $this->createCli()->getId(),
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreateProjectWithHatchNumberTooShort(): void
    {
        $payload = [
            'hatchNumber' => 'H37123',
            'name' => 'Onca Puma',
            'client' => $this->createCli()->getId(),
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreateProjectWithHatchNumberTooLong(): void
    {
        $payload = [
            'hatchNumber' => 'H3712345',
            'name' => 'Onca Puma',
            'client' => $this->createCli()->getId(),
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
