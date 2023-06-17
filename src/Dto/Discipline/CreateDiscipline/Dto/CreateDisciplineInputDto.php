<?php

declare(strict_types=1);

namespace App\Dto\Discipline\CreateDiscipline\Dto;

class CreateDisciplineInputDto
{
    //     use AssertNotNullTrait;
    //     use AssertLengthRangeTrait;

    private const ARGS = [
        'code',
        'name',
    ];

    public function __construct(public string $code, public string $name)
    {
        // $this->assertNotNull(self::ARGS, [$this->code, $this->name]);

        // $this->assertValueRangeLength($this->code, Discipline::CODE_MIN_LENGTH, Discipline::CODE_MAX_LENGTH);
        // $this->assertValueRangeLength($this->name, Discipline::NAME_MIN_LENGTH, Discipline::NAME_MAX_LENGTH);
    }

    public static function create(?string $code, ?string $name): self
    {
        return new static($code, $name);
    }
}
