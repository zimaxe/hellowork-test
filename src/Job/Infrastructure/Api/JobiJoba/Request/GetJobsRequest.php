<?php

declare(strict_types=1);

namespace App\Job\Infrastructure\Api\JobiJoba\Request;

class GetJobsRequest implements JobRequestInterface
{
    public const METHOD = 'GET';

    public function __construct(
        private readonly int $page,
        private readonly int $itemsPerPage,
        private readonly string $city,
    ) {
    }

    public function getMethod(): string
    {
        return self::METHOD;
    }

    public function getParams(): string
    {
        return http_build_query([
            'page' => $this->page,
            'limit' => $this->itemsPerPage,
            'where' => $this->city,
        ]);
    }
}
