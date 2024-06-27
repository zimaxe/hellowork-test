<?php

declare(strict_types=1);

namespace App\Job\Infrastructure\Api\JobiJoba;

readonly class JobResponse
{
    public function __construct(
        private int $statusCode,
        private array $body
    ) {
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getTotalResults(): int
    {
        return $this->body['data']['total'] ?? 0;
    }

    public function getData(): array
    {
        $ads = $this->body['data']['ads'] ?? [];

        return array_map(static function ($ad) {
            return [
                'title' => $ad['title'] ?? null,
                'description' => $ad['description'] ?? null,
                'link' => $ad['link'] ?? null,
                'city' => $ad['city'] ?? null,
                'company' => $ad['company'] ?? null,
                'contractType' => $ad['contractType'] ?? null,
                'salary' => $ad['salary'] ?? null,
            ];
        }, $ads);
    }
}
