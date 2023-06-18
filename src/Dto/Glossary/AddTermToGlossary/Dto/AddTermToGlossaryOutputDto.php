<?php

declare(strict_types=1);

namespace App\Dto\Glossary\AddTermToGlossary\Dto;

class AddTermToGlossaryOutputDto
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
