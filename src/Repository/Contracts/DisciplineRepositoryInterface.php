<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

use App\Entity\Discipline;

interface DisciplineRepositoryInterface
{
    public function add(Discipline $discipline, bool $flush): void;

    public function save(Discipline $discipline, bool $flush): void;

    public function remove(Discipline $discipline, bool $flush): void;

    public function findOneByIdOrFail(string $id): Discipline;

    public function findOneByCode(string $code): ?Discipline;
}
