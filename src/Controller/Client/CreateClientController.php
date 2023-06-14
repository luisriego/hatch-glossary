<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Dto\Client\CreateClient\CreateClient;
use Symfony\Component\HttpFoundation\Response;
use App\Dto\Client\CreateClient\Dto\CreateClientInputDto;
use App\Dto\Client\CreateClientRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreateClientController extends AbstractController
{
    public function __construct(
        private readonly CreateClient $CreateClient
    ) {
    }

    #[Route('/api/client/create', name: 'client_create', methods: ['POST'])]
    public function __invoke(CreateClientRequestDto $request): Response
    {
        $responseDto = $this->CreateClient->handle(
            CreateClientInputDto::create(
                $request->code,
                $request->name)
        );

        return $this->json(['clientId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
