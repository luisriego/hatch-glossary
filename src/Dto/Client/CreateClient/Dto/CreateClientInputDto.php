<?php

declare(strict_types=1);

namespace App\Dto\Client\CreateClient\Dto;

class CreateClientInputDto
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

        // $this->assertValueRangeLength($this->code, Client::CODE_MIN_LENGTH, Client::CODE_MAX_LENGTH);
        // $this->assertValueRangeLength($this->name, Client::NAME_MIN_LENGTH, Client::NAME_MAX_LENGTH);
    }

    public static function create(?string $code, ?string $name): self
    {
        return new static($code, $name);
    }
}
