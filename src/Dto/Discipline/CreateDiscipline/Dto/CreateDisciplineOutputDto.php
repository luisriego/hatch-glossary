<?php

declare(strict_types=1);

namespace App\Dto\Discipline\CreateDiscipline\Dto;

class CreateDisciplineOutputDto
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
