<?php

declare(strict_types=1);

namespace App\Job\Infrastructure\Api\JobiJoba;

use App\Job\Infrastructure\Api\JobiJoba\Request\JobRequestInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

readonly class JobRequestHandler
{
    public function __construct(
        private JobClient $client,
        private LoggerInterface $logger
    ) {
    }

    public function call(JobRequestInterface $request): JobResponse
    {
        try {
            $response = $this->httpCall($request);

            return new JobResponse($response->getStatusCode(), $response->toArray());
        } catch (ClientExceptionInterface $e) {
            $this->logger->error('JobijobaService: client error:'.$e->getMessage());
            throw new UnauthorizedHttpException('JobijobaService: client error', $e->getMessage(), $e);
        } catch (TransportExceptionInterface|DecodingExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|\Exception $e) {
            $this->logger->error('JobijobaService: send error:'.$e->getMessage());
            throw new \Exception('JobijobaService: send error', $e->getCode(), $e);
        }
    }

    private function httpCall(JobRequestInterface $request): ResponseInterface
    {
        // TODO add other methods
        return match ($request->getMethod()) {
            'GET' => $this->client->get($request),
            default => throw new \Exception('Method not implemented'),
        };
    }
}
