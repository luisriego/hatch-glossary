<?php

declare(strict_types=1);

namespace App\Controller\Glossary;

use App\Dto\Glossary\CreateGlossary\CreateGlossary;
use App\Dto\Glossary\CreateGlossary\Dto\CreateGlossaryInputDto;
use App\Dto\Glossary\CreateGlossaryRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateGlossaryController extends AbstractController
{
    public function __construct(
        private readonly CreateGlossary $createGlossary
    ) {
    }

    #[Route('/api/glossary/create', name: 'glossary_create', methods: ['POST'])]
    public function __invoke(CreateGlossaryRequestDto $request): Response
    {
        $responseDto = $this->createGlossary->handle(
            CreateGlossaryInputDto::create(
                $request->discipline,
                $request->project,
            )
        );

        return $this->json(['glossaryId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
