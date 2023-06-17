<?php

declare(strict_types=1);

namespace App\Exception\Discipline;

final class DisciplineAlreadyExistsException extends \DomainException
{
    public static function createFromCode(string $code): self
    {
        return new ProjectAlreadyExistsException(\sprintf('Discipline with code <%s> already exists', $code));
    }
}
