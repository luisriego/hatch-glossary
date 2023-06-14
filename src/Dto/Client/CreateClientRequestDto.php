<?php

declare(strict_types=1);

namespace App\Dto\Client;

use App\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateClientRequestDto implements RequestDto
{
    public string $code;
    public string $name;

    public function __construct(Request $request)
    {
        $this->code = $request->request->get('code');
        $this->name = $request->request->get('name');
    }
}
