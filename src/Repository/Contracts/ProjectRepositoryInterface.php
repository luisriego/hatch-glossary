<?php

declare(strict_types=1);

namespace App\Repository\Contracts;

use App\Entity\Project;

interface ProjectRepositoryInterface
{
    public function add(Project $project, bool $flush): void;

    public function save(Project $project, bool $flush): void;

    public function remove(Project $project, bool $flush): void;

    public function findOneByIdOrFail(string $id): Project;

    public function findOneById(string $id): ?Project;

    public function findOneByHatchNumber(string $hatchNumber): ?Project;
}
