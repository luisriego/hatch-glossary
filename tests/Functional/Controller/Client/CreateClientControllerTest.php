<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Client;

use App\Tests\Functional\Controller\ControllerTestBase;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateClientControllerTest extends ControllerTestBase
{
    private const ENDPOINT = '/api/client/create';

    /**
     * @throws Exception
     */
    public function testCreateClient(): void
    {
        $payload = [
            'code' => '001',
            'name' => 'VALE',
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('clientId', $responseData);
        self::assertEquals(36, \strlen($responseData['clientId']));
    }

    /**
     * @throws Exception
     */
    public function testCreateClientWithNameTooShort(): void
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
    public function testCreateClientWithNameTooLong(): void
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
    public function testCreateClientWithCodeTooShort(): void
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
    public function testCreateClientWithCodeTooLong(): void
    {
        $payload = [
            'code' => '0001',
            'name' => 'VALE',
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
