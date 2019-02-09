<?php
/**
 * Created by PhpStorm.
 * User: utietze
 * Date: 09.02.19
 * Time: 21:18
 */

namespace Firegento\CacheWarmup\Service;


use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;

class PopularityService
{
    public function incrementPopularity(CacheRouteInterface $cacheRoute): void
    {
        $currentPopularity = $cacheRoute->getPopularity() ?? 0;
        $currentPopularity++;
        $cacheRoute->setPopularity($currentPopularity);
    }
}