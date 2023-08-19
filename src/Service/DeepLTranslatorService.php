<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class DeepLTranslatorService
{
    private $httpClient;

    public function __construct(
        private readonly string $deeplApiKey,
        private readonly string $deeplApiUrl
    ) {
        $this->httpClient = HttpClient::create();
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function __invoke(?string $text, ?string $targetLang)
    {
        $response = $this->httpClient->request('POST', $this->deeplApiUrl . 'translate', [
            'headers' => [
                'Authorization' => 'DeepL-Auth-Key ' . $this->deeplApiKey,
            ],
            'body' => [
                'text' => $text,
                'target_lang' => $targetLang,
            ],
        ]);

        $data = $response->toArray();
        return $data['translations'][0]['text'];
    }
}
