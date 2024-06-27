<?php

declare(strict_types=1);

namespace App\Job\Domain\UseCase;

use App\Job\Domain\Query\FindJobsByCityQueryInterface;
use App\Job\Infrastructure\Api\JobiJoba\JobResponse;

readonly class GetJobsUseCase
{
    public function __construct(
        private FindJobsByCityQueryInterface $query
    ) {
    }

    public function execute(int $page, int $itemsPerPage, string $city): JobResponse
    {
        return $this->query->execute($page, $itemsPerPage, $city);
    }
}
