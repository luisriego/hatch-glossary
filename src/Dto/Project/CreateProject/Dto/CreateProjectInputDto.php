<?php

declare(strict_types=1);

namespace App\Dto\Project\CreateProject\Dto;

class CreateProjectInputDto
{
    //     use AssertNotNullTrait;
    //     use AssertLengthRangeTrait;

    private const ARGS = [
        'hatchNumber',
        'name',
        'client'
    ];

    public function __construct(public string $hatchNumber, public string $name, public string $client)
    {
        // $this->assertNotNull(self::ARGS, [$this->code, $this->name]);

        // $this->assertValueRangeLength($this->code, Project::CODE_MIN_LENGTH, Project::CODE_MAX_LENGTH);
        // $this->assertValueRangeLength($this->name, Project::NAME_MIN_LENGTH, Project::NAME_MAX_LENGTH);
    }

    public static function create(?string $hatchNumber, ?string $name, ?string $client): self
    {
        return new static($hatchNumber, $name, $client);
    }
}
