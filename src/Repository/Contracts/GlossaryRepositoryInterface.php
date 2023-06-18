<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

use App\Entity\Glossary;

interface GlossaryRepositoryInterface
{
    public function add(Glossary $glossary, bool $flush): void;

    public function save(Glossary $glossary, bool $flush): void;

    public function remove(Glossary $glossary, bool $flush): void;

    public function findOneByIdOrFail(string $id): Glossary;

    public function findOneOrFail(): Glossary;
}
