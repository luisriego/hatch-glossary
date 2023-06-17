<?php

declare(strict_types=1);

namespace App\Controller\Discipline;


use App\Dto\Discipline\CreateDiscipline\CreateDiscipline;
use App\Dto\Discipline\CreateDiscipline\Dto\CreateDisciplineInputDto;
use App\Dto\Discipline\CreateDisciplineRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateDisciplineController extends AbstractController
{
    public function __construct(
        private readonly CreateDiscipline $createDiscipline
    ) {
    }

    #[Route('/api/discipline/create', name: 'discipline_create', methods: ['POST'])]
    public function __invoke(CreateDisciplineRequestDto $request): Response
    {
        $responseDto = $this->createDiscipline->handle(
            CreateDisciplineInputDto::create(
                $request->code,
                $request->name)
        );

        return $this->json(['disciplineId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
