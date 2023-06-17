<?php

declare(strict_types=1);

namespace App\Exception\Project;

final class ProjectAlreadyExistsException extends \DomainException
{
    public static function createFromCode(string $code): self
    {
        return new ProjectAlreadyExistsException(\sprintf('Project with Nunber <%s> already exists', $code));
    }
}
