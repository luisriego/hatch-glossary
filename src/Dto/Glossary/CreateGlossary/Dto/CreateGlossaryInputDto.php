<?php

declare(strict_types=1);

namespace App\Dto\Glossary\CreateGlossary\Dto;

class CreateGlossaryInputDto
{
    //     use AssertNotNullTrait;
    //     use AssertLengthRangeTrait;

    private const ARGS = [
        'discipline',
        'project',
    ];

    public function __construct(public string $discipline, public string $project)
    {
        // $this->assertNotNull(self::ARGS, [$this->code, $this->name]);

        // $this->assertValueRangeLength($this->code, Glossary::CODE_MIN_LENGTH, Glossary::CODE_MAX_LENGTH);
        // $this->assertValueRangeLength($this->name, Glossary::NAME_MIN_LENGTH, Glossary::NAME_MAX_LENGTH);
    }

    public static function create(?string $discipline, ?string $project): self
    {
        return new static($discipline, $project);
    }
}
