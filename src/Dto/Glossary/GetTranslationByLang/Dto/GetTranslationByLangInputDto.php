<?php

declare(strict_types=1);

namespace App\Dto\Glossary\GetTranslationByLang\Dto;

use App\Entity\Glossary;
use App\Validation\Trait\AssertLengthRangeTrait;
use App\Validation\Trait\AssertNotNullTrait;

class GetTranslationByLangInputDto
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;

    private const ARGS = [
        'glossary',
        'term',
        'language',
    ];

    public function __construct(public string $glossary, public string $term, public string $language)
    {
        $this->assertNotNull(self::ARGS, [$this->glossary, $this->term, $this->language]);

        $this->assertValueRangeLength($this->glossary, Glossary::GLOSSARY_MIN_LENGTH, Glossary::GLOSSARY_MAX_LENGTH);
        $this->assertValueRangeLength($this->term, Glossary::TERM_MIN_LENGTH, Glossary::TERM_MAX_LENGTH);
        $this->assertValueRangeLength($this->language, Glossary::LANGUAGE_MIN_LENGTH, Glossary::LANGUAGE_MAX_LENGTH);
    }

    public static function add(string $glossary, ?string $term, ?string $language): self
    {
        return new static($glossary, $term, $language);
    }
}
