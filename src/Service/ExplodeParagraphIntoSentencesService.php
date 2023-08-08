<?php

declare(strict_types=1);

namespace App\Service;

class ExplodeParagraphIntoSentencesService
{
    public function __construct()
    {
    }

    public function handle(string $paragraph): array
    {
        return $this->explodeParagraphIntoSentences($paragraph);
    }

    // function to explode paragraph into sentences
    function explodeParagraphIntoSentences($paragraph)
    {
        return preg_split('/(?<=[.!?])\s+/', $paragraph, -1, PREG_SPLIT_NO_EMPTY);
    }
}