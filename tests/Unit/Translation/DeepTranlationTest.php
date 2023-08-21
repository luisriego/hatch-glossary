<?php

declare(strict_types=1);

namespace App\Tests\Unit\Translation;


use App\Service\DeepLTranslatorService;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;

class DeepTranlationTest extends TestCase
{
    private readonly DeepLTranslatorService $deepLTranslatorService;


    public function setUp(): void
    {
        $this->deepLTranslatorService = new DeepLTranslatorService($deeplKey, 'https://api-free.deepl.com/v2/');
    }

    /**
     * @throws GuzzleException
     */
    public function testTraslateTest(): void
    {
        $paragraph = "Hello, this is the first sentence. This is the second sentence! And finally, the last sentence?";
        $expectedSentences = "Hola, esta es la primera frase. Esta es la segunda frase. Y finalmente, ¿la última frase?";

        $translatedTex = $this->deepLTranslatorService->__invoke($paragraph, "ES");

        $this->assertEquals($expectedSentences, $translatedTex);
    }
}
