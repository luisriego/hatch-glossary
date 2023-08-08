<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Service\ExplodeParagraphIntoSentencesService;

class ExplodeParagraphTest extends TestCase
{
    private ExplodeParagraphIntoSentencesService $explodeParagraphIntoSentencesService;

    public function setUp(): void
    {
        $this->explodeParagraphIntoSentencesService = new ExplodeParagraphIntoSentencesService();
    }

    public function testCreateClient(): void
    {
        $paragraph = "Hello, this is the first sentence. This is the second sentence! And finally, the last sentence?";
        $expectedSentences = [
            "Hello, this is the first sentence.",
            "This is the second sentence!",
            "And finally, the last sentence?"
        ];

        $actualSentences = $this->explodeParagraphIntoSentencesService->handle($paragraph);

        $this->assertEquals($expectedSentences, $actualSentences);
    }
}