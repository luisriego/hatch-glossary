<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Glossary;

use App\Tests\Functional\Controller\ControllerTestBase;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateGlossaryControllerTest extends ControllerTestBase
{
    private const ENDPOINT = '/api/glossary/create';

    /**
     * @throws Exception
     */
    public function testCreateGlossary(): void
    {
        $payload = [
            'discipline' => $this->createDiscipline()->getId(),
            'project' => $this->createProject()->getId(),
        ];


        self::$user->request(Request::METHOD_POST, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('glossaryId', $responseData);
        self::assertEquals(36, \strlen($responseData['glossaryId']));
    }
}
