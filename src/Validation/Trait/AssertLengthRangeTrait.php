<?php

declare(strict_types=1);

namespace App\Validation\Trait;

use App\Exception\InvalidArgumentException;

class AssertLengthRangeTrait
{
    public function assertValueRangeLength(string $value, int $min, int $max): void
    {
        if (\strlen($value) < $min || \strlen($value) > $max) {
            throw InvalidArgumentException::createFromMinAndMaxLength($min, $max);
        }
    }
}
