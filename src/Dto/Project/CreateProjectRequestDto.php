<?php

declare(strict_types=1);

namespace App\Dto\Project;

use App\Dto\RequestDto;
use Symfony\Component\HttpFoundation\Request;

class CreateProjectRequestDto implements RequestDto
{
    public string $hatchNumber;
    public string $name;
    public string $client;

    public function __construct(Request $request)
    {
        $this->hatchNumber = $request->request->get('hatchNumber');
        $this->name = $request->request->get('name');
        $this->client = $request->request->get('client');
    }
}
