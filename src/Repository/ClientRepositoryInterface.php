<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Client;

interface ClientRepositoryInterface
{
    public function add(Client $client, bool $flush): void;

    public function save(Client $client, bool $flush): void;

    public function remove(Client $client, bool $flush): void;

    public function findOneByIdOrFail(string $id): Client;

    public function findOneByCode(string $code): ?Client;
}