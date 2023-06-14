<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Dto\Client\CreateClient\CreateClient;
use App\Dto\Client\CreateClient\Dto\CreateClientInputDto;
use App\Dto\Client\CreateClientRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateClientController extends AbstractController
{
    public function __construct(
        private readonly CreateClient $createClient
    ) {
    }

    #[Route('/api/client/create', name: 'client_create', methods: ['POST'])]
    public function __invoke(CreateClientRequestDto $request): Response
    {
//        $parameters = json_decode($request->getContent(), true);
//        $response = Client::create(
//            $parameters['code'],
//            $parameters['name']
//        );



        $responseDto = $this->createClient->handle(
            CreateClientInputDto::create(
                $request->code,
                $request->name)
        );

//        return $this->json(['clientId' => $response->getId()], Response::HTTP_CREATED);
        return $this->json(['clientId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
