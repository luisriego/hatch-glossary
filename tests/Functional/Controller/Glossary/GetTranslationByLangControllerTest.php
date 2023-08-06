<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\Glossary;

use App\Tests\Functional\Controller\ControllerTestBase;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetTranslationByLangControllerTest extends ControllerTestBase
{
    private const ENDPOINT = '/api/glossary/get-translation-by-language/%s/%s/%s';

    /**
     * @throws Exception
     */
    public function testGetTranslationByLanguage(): void
    {
        $glossary = $this->getOneGlossary()->getId();
        $term = 'crane';
        $language = 'en';

        self::$user->request(Request::METHOD_GET, \sprintf(self::ENDPOINT, $glossary, $term, $language));

        $response = self::$user->getResponse();
        $responseData = $this->getResponseData($response)[0];

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertArrayHasKey('en', $responseData);
        self::assertArrayHasKey('es', $responseData);
        self::assertArrayHasKey('pt', $responseData);
    }
}
