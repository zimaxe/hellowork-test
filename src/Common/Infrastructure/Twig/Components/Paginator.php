<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('paginator')]
class Paginator
{
    // TODO: USE white-october/pagerfanta-bundle instead of Symfony UX/Twig Component

    public function __construct(
        public int $currentPage = 1,
        public int $totalPages = 1,
        public int $totalItems = 1,
        public int $itemsPerPage = 25,
        public int $maxPages = 50
    ) {
    }

    public function paginate(): array
    {
        $calculatedTotalPages = (int) ceil($this->totalItems / $this->itemsPerPage);

        if ($calculatedTotalPages > $this->maxPages) {
            $calculatedTotalPages = max($calculatedTotalPages, $this->maxPages);
        }

        $this->totalPages = min($calculatedTotalPages, $this->maxPages);

        $pagination = [];

        for ($page = max(1, $this->currentPage - 2); $page <= min($this->currentPage + 2, $this->totalPages); ++$page) {
            $pagination['links'][$page] = '?page='.$page;
        }

        return $pagination;
    }
}
