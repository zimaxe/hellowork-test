<?php

declare(strict_types=1);

namespace App\Job\Infrastructure\Api\JobiJoba;

use App\Job\Infrastructure\Api\JobiJoba\Request\JobRequestInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

readonly class JobClient
{
    public function __construct(
        private HttpClientInterface $client,
        private string $jobiJobaApiPath,
        private string $jobiJobaClientId,
        private string $jobiJobaClientSecret,
    ) {
    }

    public function get(JobRequestInterface $request): ResponseInterface
    {
        return $this->client->request('GET', $this->jobiJobaApiPath.'ads/search?'.$request->getParams(), [
            'auth_bearer' => $this->getToken(),
        ]);
    }

    private function getToken(): ?string
    {
        $accessToken = $this->client->request('POST', $this->jobiJobaApiPath.'login', [
            'json' => [
                'client_id' => $this->jobiJobaClientId,
                'client_secret' => $this->jobiJobaClientSecret,
            ],
        ]);

        $response = $accessToken->toArray();

        return $response['token'] ?? null;
    }
}
