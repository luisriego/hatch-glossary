<?php

declare(strict_types=1);

namespace App\Dto\Project\CreateProject\Dto;

use App\Entity\Project;
use App\Validation\Trait\AssertLengthRangeTrait;
use App\Validation\Trait\AssertNotNullTrait;

class CreateProjectInputDto
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;

    private const ARGS = [
        'hatchNumber',
        'name',
    ];

    public function __construct(public string $hatchNumber, public string $name, public string $client)
    {
        $this->assertNotNull(self::ARGS, [$this->hatchNumber, $this->name]);

        $this->assertValueRangeLength($this->hatchNumber, Project::HATCHNUMBER_MIN_LENGTH, Project::HATCHNUMBER_MAX_LENGTH);
        $this->assertValueRangeLength($this->name, Project::NAME_MIN_LENGTH, Project::NAME_MAX_LENGTH);
    }

    public static function create(?string $hatchNumber, ?string $name, ?string $client): self
    {
        return new static($hatchNumber, $name, $client);
    }
}
