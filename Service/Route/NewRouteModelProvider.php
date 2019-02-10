<?php
/**
 * Created by PhpStorm.
 * User: utietze
 * Date: 10.02.19
 * Time: 12:45
 */

namespace Firegento\CacheWarmup\Service\Route;


use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;
use Firegento\CacheWarmup\Api\Data\CacheRouteInterfaceFactory;

class NewRouteModelProvider
{

    /**
     * @var CacheRouteInterfaceFactory
     */
    protected $cacheRouteInterfaceFactory;

    public function __construct(CacheRouteInterfaceFactory $cacheRouteInterfaceFactory)
    {
        $this->cacheRouteInterfaceFactory = $cacheRouteInterfaceFactory;
    }

    public function createForRoute(string $route, int $cacheStatus = 0, int $lifetime = 86400, int $popularity = 0): CacheRouteInterface
    {
        /** @var CacheRouteInterface $freshCacheRoute */
        $freshCacheRoute = $this->cacheRouteInterfaceFactory->create();
        $freshCacheRoute->setRoute($route);
        $freshCacheRoute->setCacheStatus($cacheStatus);
        $freshCacheRoute->setLifetime($lifetime);
        $freshCacheRoute->setPopularity($popularity);

        return $freshCacheRoute;
    }
}