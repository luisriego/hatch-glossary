<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Condo;

use App\Tests\Functional\Controller\ControllerTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateClientControllerTest extends ControllerTestBase
{
    private const ENDPOINT = '/api/client/create';

    public function testCreateClient(): void
    {
        $payload = [
            'code' => '001',
            'name' => 'Vale',
        ];

        
        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('condoId', $responseData);
        self::assertEquals(36, \strlen($responseData['condoId']));
    }
}