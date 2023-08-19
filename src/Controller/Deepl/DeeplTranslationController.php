<?php

declare(strict_types=1);

namespace App\Controller\Deepl;

use App\Dto\Deepl\TranslateRequestDto;
use App\Service\DeepLTranslatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class DeeplTranslationController extends AbstractController
{
    public function __construct(
        private readonly DeepLTranslatorService $deepLTranslatorService
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/api/translate', name: 'translate', methods: ['POST'])]
    public function __invoke(TranslateRequestDto $request): Response
    {
        $text = $request->text;
        $targetLang = $request->lang;
//        $text = "Hello, how are you?";
//        $targetLang = 'DE'; // Replace with your desired target language code.

        $translatedText = $this->deepLTranslatorService->__invoke($text, $targetLang);

        return $this->json(['translation' => $translatedText], Response::HTTP_OK);
    }
}