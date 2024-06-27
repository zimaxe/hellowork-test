<?php

declare(strict_types=1);

namespace App\Job\Presentation\Web\Action;

use App\Job\Domain\UseCase\GetJobsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/', name: 'home_page', methods: ['GET'])]
class HomePageAction extends AbstractController
{
    private const ITEMS_PER_PAGE = 9;
    private const FILTERED_CITY = 'Biarritz';

    public function __construct(private readonly GetJobsUseCase $getJobsUseCase)
    {
    }

    public function __invoke(
        #[MapQueryParameter] int $page = 1
    ): Response {
        try {
            $jobs = $this->getJobsUseCase->execute($page, self::ITEMS_PER_PAGE, self::FILTERED_CITY);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }

        return $this->render('jobs/home.html.twig', [
            'jobs' => $jobs,
            'currentPage' => $page,
        ]);
    }
}
