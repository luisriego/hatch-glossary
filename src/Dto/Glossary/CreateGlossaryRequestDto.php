<?php

declare(strict_types=1);

namespace App\Dto\Glossary;

use App\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateGlossaryRequestDto implements RequestDto
{
    public string $discipline;
    public string $project;

    public function __construct(Request $request)
    {
        $this->discipline = $request->request->get('discipline');
        $this->project = $request->request->get('project');
    }
}
