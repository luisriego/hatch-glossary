<?php

declare(strict_types=1);

namespace App\Dto\Deepl;

use App\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class TranslateRequestDto implements RequestDto
{
    public string $text;
    public string $lang;


    public function __construct(Request $request)
    {
        $this->text = $request->request->get('text');
        $this->lang = $request->request->get('lang');
    }
}
