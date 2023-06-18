<?php

declare(strict_types=1);

namespace App\Dto\Glossary\AddTermToGlossary;

use App\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class AddTermToGlossaryRequestDto implements RequestDto
{
    public string $glossary;
    public string $en;
    public string $es;
    public string $pt;

    public function __construct(Request $request)
    {
        $this->glossary = $request->request->get('glossary');
        $this->en = $request->request->get('en');
        $this->es = $request->request->get('es');
        $this->pt = $request->request->get('pt');
    }
}
