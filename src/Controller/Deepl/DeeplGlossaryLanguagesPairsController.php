<?php

declare(strict_types=1);

namespace App\Controller\Deepl;

use App\Dto\Deepl\TranslateRequestDto;
use App\Service\DeepLLanguagesPairsService;
use App\Service\DeepLTranslatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class DeeplGlossaryLanguagesPairsController extends AbstractController
{
    public function __construct(
        private readonly DeepLLanguagesPairsService $languagesPairsService
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/api/glossary-language-pairs', name: 'glossary_language_pairs', methods: ['GET'])]
    public function __invoke(): Response
    {
        $glossaryLanguagesPairs = $this->languagesPairsService->__invoke();

        return $this->json(['Languages pairs' => $glossaryLanguagesPairs], Response::HTTP_OK);
    }
}