<?php

declare(strict_types=1);

namespace App\Dto\Project\CreateProject\Dto;

class CreateProjectOutputDto
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
