<?php

declare(strict_types=1);

namespace App\Controller\Glossary;

use App\Dto\Glossary\AddTermToGlossary\AddTermToGlossary;
use App\Dto\Glossary\AddTermToGlossary\AddTermToGlossaryRequestDto;
use App\Dto\Glossary\AddTermToGlossary\Dto\AddTermToGlossaryInputDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddTermToGlossaryController extends AbstractController
{
    public function __construct(
        private readonly AddTermToGlossary $addTermToGlossary
    ) {
    }

    #[Route('/api/glossary/add-term', name: 'glossary_add_term', methods: ['PUT'])]
    public function __invoke(AddTermToGlossaryRequestDto $request): Response
    {
        $this->addTermToGlossary->handle(
            AddTermToGlossaryInputDto::add(
                $request->glossary,
                $request->en,
                $request->es,
                $request->pt,
            )
        );

        return $this->json([], Response::HTTP_OK);
    }
}
