<?php

declare(strict_types=1);

namespace App\CustomerDataPlatform\Http;

use App\CustomerDataPlatform\Analytics\Model\ModelInterface;
use JsonException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CDPClient
{
    private const string CDP_API_URL = 'https://some-cdp-api.com/';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
        #[Autowire('%cdp.api_key%')] private readonly string $apiKey
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     */
    public function track(ModelInterface $model): void
    {
        $this->httpClient->request(
            'POST',
            self::CDP_API_URL . '/track',
            [
                'body' => json_encode($model->toArray(), JSON_THROW_ON_ERROR),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'API-KEY' => $this->apiKey,
                ]
            ]
        );
        // Todo: add error handling
    }

    /**
     * @throws TransportExceptionInterface
     * @throws JsonException
     */
    public function identify(ModelInterface $model): void
    {
        $this->httpClient->request(
            'POST',
            self::CDP_API_URL . '/identify',
            [
                'body' => json_encode($model->toArray(), JSON_THROW_ON_ERROR),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'API-KEY' => $this->apiKey,
                ]
            ]
        );
        // Todo: add error handling
    }
}
