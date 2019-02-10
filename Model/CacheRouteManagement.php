<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model;

use Firegento\CacheWarmup\Api\CacheRouteManagementInterface;
use Firegento\CacheWarmup\Model\Route\Management\IncrementPopularityById;
use Firegento\CacheWarmup\Model\Route\Management\IncrementPopularityByRoute;

class CacheRouteManagement implements CacheRouteManagementInterface
{
    /**
     * @var IncrementPopularityById
     */
    protected $incrementPopularityById;
    /**
     * @var IncrementPopularityByRoute
     */
    protected $incrementPopularityByRoute;

    public function __construct(
        IncrementPopularityById $incrementPopularityById,
        IncrementPopularityByRoute $incrementPopularityByRoute
    ) {
        $this->incrementPopularityById = $incrementPopularityById;
        $this->incrementPopularityByRoute = $incrementPopularityByRoute;
    }

    public function incrementPopularityByRoute(string $route): void
    {
        $this->incrementPopularityByRoute->execute($route);
    }

    public function incrementPopularityById(int $routeId): void
    {
        $this->incrementPopularityById->execute($routeId);
    }
}
