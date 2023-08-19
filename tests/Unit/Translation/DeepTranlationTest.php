<?php

declare(strict_types=1);

namespace App\Tests\Unit\Translation;


use App\Service\DeepLTranslatorService;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

class DeepTranlationTest extends TestCase
{

    private readonly DeepLTranslatorService $deepLTranslatorService;


    public function setUp(): void
    {
        $this->deepLTranslatorService = new DeepLTranslatorService('$0b9ccd94-30dd-83a6-6c9d-901370c7afbc:fx', 'api-free.deepl.com');
    }

    /**
     * @throws GuzzleException
     */
    public function testCreateClient(): void
    {
        $paragraph = "Hello, this is the first sentence. This is the second sentence! And finally, the last sentence?";
        $expectedSentences = [
            "Hello, this is the first sentence.",
            "This is the second sentence!",
            "And finally, the last sentence?"
        ];

        $translatedTex = $this->deepLTranslatorService->translate($paragraph, "ES");

        $this->assertEquals($expectedSentences, $translatedTex);
    }
}