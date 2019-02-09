<?php declare(strict_types=1);


namespace Firegento\CacheWarmup\Model;


use Firegento\CacheWarmup\Api\CacheRouteRepositoryInterface;
use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;

class CacheRouteRepository implements CacheRouteRepositoryInterface
{

    public function getById(int $id):? CacheRouteInterface
    {
        // TODO: Implement getById() method.
    }

    public function getByRoute(string $route):? CacheRouteInterface
    {
        // TODO: Implement getByRoute() method.
    }
}