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
            'code' => '001',
            'name' => 'VALE',
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('disciplineId', $responseData);
        self::assertEquals(36, \strlen($responseData['disciplineId']));
    }
}
{

}