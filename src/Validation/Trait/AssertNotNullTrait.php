<?php

declare(strict_types=1);

namespace App\Validation\Trait;

use App\Exception\InvalidArgumentException;

class AssertNotNullTrait
{
    public function assertNotNull(array $args, array $values): void
    {
        $args = \array_combine($args, $values);

        $emptyValues = [];
        foreach ($args as $key => $value) {
            if (\is_null($value)) {
                $emptyValues[] = $key;
            }
        }

        if (!empty($emptyValues)) {
            throw InvalidArgumentException::createFromArray($emptyValues);
        }
    }
}
