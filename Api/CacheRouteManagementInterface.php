<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api;

interface CacheRouteManagementInterface
{
    /**
     * @param string $route
     * @return void
     */
    public function incrementPopularityByRoute(string $route): void;

    /**
     * @param int $routeId
     * @return void
     */
    public function incrementPopularityById(int $routeId): void;
}
