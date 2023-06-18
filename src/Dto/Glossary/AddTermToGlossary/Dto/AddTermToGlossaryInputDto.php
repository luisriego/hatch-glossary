<?php

declare(strict_types=1);

namespace App\Dto\Glossary\AddTermToGlossary\Dto;

use App\Entity\Glossary;
use App\Validation\Trait\AssertLengthRangeTrait;
use App\Validation\Trait\AssertNotNullTrait;

class AddTermToGlossaryInputDto
{
         use AssertNotNullTrait;
         use AssertLengthRangeTrait;

    private const ARGS = [
        'glossary',
    ];

    public function __construct(public string $glossary, public string $en, public string $es, public string $pt)
    {
         $this->assertNotNull(self::ARGS, [$this->glossary]);

         $this->assertValueRangeLength($this->glossary, Glossary::GLOSSARY_MIN_LENGTH, Glossary::GLOSSARY_MAX_LENGTH);
    }

    public static function add(string $glossary, ?string $en, ?string $es, ?string $pt): self
    {
        return new static($glossary, $en, $es, $pt);
    }
}
