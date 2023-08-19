<?php

declare(strict_types=1);

namespace App\Controller\Project;

use App\Dto\Project\CreateProject\CreateProject;
use App\Dto\Project\CreateProjectRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateProjectController extends AbstractController
{
    public function __construct(
        private readonly CreateProject $createProject
    ) {
    }

    #[Route('/api/project/create', name: 'project_create', methods: ['POST'])]
    public function __invoke(CreateProjectRequestDto $request): Response
    {
        $responseDto = $this->createProject->handle(
            CreateProjectRequestDto::create(
                $request->hatchNumber,
                $request->name,
                $request->client,
            )
        );

        return $this->json(['projectId' => $responseDto->id], Response::HTTP_CREATED);
    }
}
