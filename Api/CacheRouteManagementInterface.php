<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api;

interface CacheRouteManagementInterface
{
    public function incrementPopularityByRoute(string $route): void;

    public function incrementPopularityById(int $routeId): void;
}
