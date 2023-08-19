<?php

declare(strict_types=1);

namespace App\Dto\Deepl\Translate\Dto;

class TranslateOutputDto
{
    public string $translation;

    public function __construct(string $translation)
    {
        $this->translation = $translation;
    }
}
