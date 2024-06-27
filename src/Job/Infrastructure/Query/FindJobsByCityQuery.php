<?php

declare(strict_types=1);

namespace App\Job\Infrastructure\Query;

use App\Job\Domain\Query\FindJobsByCityQueryInterface;
use App\Job\Infrastructure\Api\JobiJoba\JobRequestHandler;
use App\Job\Infrastructure\Api\JobiJoba\JobResponse;
use App\Job\Infrastructure\Api\JobiJoba\Request\GetJobsRequest;

readonly class FindJobsByCityQuery implements FindJobsByCityQueryInterface
{
    public function __construct(
        private JobRequestHandler $handler
    ) {
    }

    public function execute(int $page, int $itemsPerPage, string $city): JobResponse
    {
        $request = new GetJobsRequest($page, $itemsPerPage, $city);

        return $this->handler->call($request);
    }
}
