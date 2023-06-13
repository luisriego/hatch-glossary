<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends ControllerTestBase
{
    private const ENDPOINT = '/api/health-check';

    public function testHealthCheck(): void
    {
        self::$user->request(Request::METHOD_GET, self::ENDPOINT);

        $response = self::$user->getResponse();
        $responseData = json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Api up and running!', $responseData['message']);
    }
}