<?php

declare(strict_types=1);

namespace App\Dto\Deepl\Translate\Dto;

use App\Entity\Project;
use App\Validation\Trait\AssertLengthRangeTrait;
use App\Validation\Trait\AssertNotNullTrait;

class TranslateInputDto
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;

    private const ARGS = [
        'text',
        'lang',
    ];

    public function __construct(public string $text, public string $lang)
    {
        $this->assertNotNull(self::ARGS, [$this->text, $this->lang]);

        $this->assertValueRangeLength($this->text, 1, 5000);
        $this->assertValueRangeLength($this->lang, 2, 2);
    }

    public static function create(?string $text, ?string $lang): self
    {
        return new static($text, $lang);
    }
}
