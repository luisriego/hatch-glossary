<?php

declare(strict_types=1);

namespace App\Controller\Glossary;

use App\Dto\Glossary\GetTranslationByLang\Dto\GetTranslationByLangInputDto;
use App\Dto\Glossary\GetTranslationByLang\GetTranslationByLang;
use App\Dto\Glossary\GetTranslationByLang\GetTranslationByLangRequestDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetTranslationByLangController extends AbstractController
{
    public function __construct(
        private readonly GetTranslationByLang $getTranslationByLang
    ) {
    }

    #[Route('/api/glossary/get-translation-by-language/{glossary}/{term}/{language}', name: 'glossary_get_translation_language', methods: ['GET'])]
    public function __invoke(GetTranslationByLangRequestDto $request): Response
    {
        $glossary = $this->getTranslationByLang->handle(
            GetTranslationByLangInputDto::add(
                $request->glossary,
                $request->term,
                $request->language,
            )
        );

        return $this->json([$glossary], Response::HTTP_OK);
    }
}
