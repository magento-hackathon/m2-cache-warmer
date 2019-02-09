<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api;

use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;

interface CacheRouteRepositoryInterface
{
    public function getById(int $id):? CacheRouteInterface;

    public function getByRoute(string $route):? CacheRouteInterface;
}