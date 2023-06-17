<?php

declare(strict_types=1);

namespace App\Dto\Discipline;

use App\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateDisciplineRequestDto implements RequestDto
{
    public string $code;
    public string $name;

    public function __construct(Request $request)
    {
        $this->code = $request->request->get('code');
        $this->name = $request->request->get('name');
    }
}
