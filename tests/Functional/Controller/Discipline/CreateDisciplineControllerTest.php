<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Discipline;

use App\Tests\Functional\Controller\ControllerTestBase;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateDisciplineControllerTest extends ControllerTestBase
{
    private const ENDPOINT = '/api/discipline/create';

    /**
     * @throws Exception
     */
    public function testCreateDiscipline(): void
    {
        $payload = [
            'code' => '100',
            'name' => 'Project Management',
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('disciplineId', $responseData);
        self::assertEquals(36, \strlen($responseData['disciplineId']));
    }

    /**
     * @throws Exception
     */
    public function testCreateDisciplineWithNameTooShort(): void
    {
        $payload = [
            'code' => '001',
            'name' => 'VAL',
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testCreateDisciplineWithNameTooLong(): void
    {
        $payload = [
            'code' => '001',
            'name' => 'When you want to add application tests for protected pages, you have to first "login" as a user. Reproducing the actual steps - such as submitting a login form - makes a test very slow. For this reason, Symfony provides a loginUser() method to simulate logging in your functional tests.',
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testCreateDisciplineWithCodeTooShort(): void
    {
        $payload = [
            'code' => '00',
            'name' => 'VALE',
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    /**
     * @throws Exception
     */
    public function testCreateDisciplineWithCodeTooLong(): void
    {
        $payload = [
            'code' => '000001',
            'name' => 'VALE',
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
