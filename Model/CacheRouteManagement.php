<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model;

use Firegento\CacheWarmup\Api\CacheRouteManagementInterface;
use Firegento\CacheWarmup\Api\CacheRouteRepositoryInterface;
use Firegento\CacheWarmup\Service\PopularityService;

class CacheRouteManagement implements CacheRouteManagementInterface
{
    /**
     * @var PopularityService
     */
    protected $popularityService;
    /**
     * @var CacheRouteRepositoryInterface
     */
    private $cacheRouteRepository;

    public function __construct(
        CacheRouteRepositoryInterface $cacheRouteRepository,
        PopularityService $popularityService
    ) {
        $this->cacheRouteRepository = $cacheRouteRepository;
        $this->popularityService = $popularityService;
    }

    public function incrementPopularityByRoute(string $route): void
    {
        $routeModel = $this->cacheRouteRepository->getByRoute($route);
        $this->popularityService->incrementPopularity($routeModel);

        $this->cacheRouteRepository->save($routeModel);
    }

    public function incrementPopularityById(int $routeId): void
    {
        $routeModel = $this->cacheRouteRepository->getById($routeId);
        $this->popularityService->incrementPopularity($routeModel);

        $this->cacheRouteRepository->save($routeModel);
    }
}
