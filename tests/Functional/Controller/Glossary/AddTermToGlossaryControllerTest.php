<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Glossary;

use App\Tests\Functional\Controller\ControllerTestBase;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddTermToGlossaryControllerTest extends ControllerTestBase
{
    private const ENDPOINT = '/api/glossary/add-term';

    /**
     * @throws Exception
     */
    public function testAddTermToGlossary(): void
    {
        $payload = [
            'glossary' => $this->getOneGlossary()->getId(),
            'en' => 'hello',
            'es' => 'hola',
            'pt' => 'olá',
        ];


        self::$user->request(Request::METHOD_PUT, self::ENDPOINT,[], [], [], \json_encode($payload));

        $response = self::$user->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
//        self::assertArrayHasKey('glossaryId', $responseData);
//        self::assertEquals(36, \strlen($responseData['glossaryId']));
    }
}
