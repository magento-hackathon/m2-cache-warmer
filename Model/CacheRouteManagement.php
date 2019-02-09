<?php
declare(strict_types=1);

namespace Firegento\CacheWarmup\Model;

use Firegento\CacheWarmup\Api\CacheRouteManagementInterface;
use Firegento\CacheWarmup\Api\CacheRouteRepositoryInterface;

class CacheRouteManagement implements CacheRouteManagementInterface
{
    /**
     * @var CacheRouteRepositoryInterface
     */
    private $cacheRouteRepository;

    public function __construct(CacheRouteRepositoryInterface $cacheRouteRepository)
    {
        $this->cacheRouteRepository = $cacheRouteRepository;
    }

    public function incrementPopularityByRoute(string $route)
    {
        $routeModel = $this->cacheRouteRepository->getByRoute($route);
        $routeModel->incrementPopularity();
        $this->cacheRouteRepository->save($routeModel);
    }

    public function incrementPopularityById(int $routeId)
    {
        $routeModel = $this->cacheRouteRepository->getById($routeId);
        $routeModel->incrementPopularity();
        $this->cacheRouteRepository->save($routeModel);
    }
}
