<?php

declare(strict_types=1);

namespace App\Dto\Glossary\GetTranslationByLang\Dto;

use App\Entity\Glossary;

class GetTranslationByLangOutputDto
{
    public function __construct(
        public readonly ?string $en,
        public readonly ?string $es,
        public readonly ?string $pt,
    ) {
    }

    public static function create(Glossary $glossary): self
    {
        return new self(
            $glossary->getEn(),
            $glossary->getEs(),
            $glossary->getPt(),
        );
    }
}
