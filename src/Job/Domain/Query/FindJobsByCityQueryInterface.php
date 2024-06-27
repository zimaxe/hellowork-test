<?php

declare(strict_types=1);

namespace App\Job\Domain\Query;

use App\Job\Infrastructure\Api\JobiJoba\JobResponse;

interface FindJobsByCityQueryInterface
{
    public function execute(int $page, int $itemsPerPage, string $city): JobResponse;
}
