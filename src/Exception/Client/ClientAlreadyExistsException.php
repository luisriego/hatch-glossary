<?php

declare(strict_types=1);

namespace App\Exception\Client;

final class ClientAlreadyExistsException extends \DomainException
{
    public static function createFromCode(string $code): self
    {
        return new DisciplineAlreadyExistsException(\sprintf('Client with code <%s> already exists', $code));
    }
}
