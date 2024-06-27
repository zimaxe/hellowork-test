<?php

declare(strict_types=1);

namespace App\Job\Infrastructure\Api\JobiJoba\Request;

interface JobRequestInterface
{
    public function getMethod(): string;

    public function getParams(): string;
}
