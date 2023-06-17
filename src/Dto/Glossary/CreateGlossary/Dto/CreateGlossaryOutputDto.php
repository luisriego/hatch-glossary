<?php

declare(strict_types=1);

namespace App\Dto\Glossary\CreateGlossary\Dto;

class CreateGlossaryOutputDto
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
