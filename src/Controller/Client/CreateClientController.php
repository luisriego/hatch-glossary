<?php

declare(strict_types=1);

namespace App\Controller\Client;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CreateClientController extends AbstractController
{
    public function __construct(
        // private readonly CreateClient $CreateClient
    ) {
    }

    #[Route('/api/client/create', name: 'client_create', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $responseDto = $this->CreateClient->handle(
            CreateClientInputDto::create(
                $request->code,
                $request->name)
        );

        return $this->json(['clientId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
