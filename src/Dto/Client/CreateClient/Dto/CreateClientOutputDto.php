<?php

declare(strict_types=1);

namespace App\Dto\Client\CreateClient\Dto;

class CreateClientOutputDto
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
