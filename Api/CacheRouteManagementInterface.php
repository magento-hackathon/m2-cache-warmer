<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api;

interface CacheRouteManagementInterface
{
    public function incrementPopularityByRoute(string $route);

    public function incrementPopularityById(int $routeId);
}
