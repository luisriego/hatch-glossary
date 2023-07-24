<?php

declare(strict_types=1);

namespace App\Dto\Glossary\GetTranslationByLang;

use App\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class GetTranslationByLangRequestDto implements RequestDto
{
    public string $glossary;
    public string $term;
    public string $language;

    public function __construct(Request $request)
    {
        $this->glossary = $request->attributes->get('glossary');
        $this->term = $request->attributes->get('term');
        $this->language = $request->attributes->get('language');
    }
}
