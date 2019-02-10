<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api;

use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterface;

interface RoutesTagsLinkManagementInterface
{
    /**
     * @param CacheRouteInterface $cacheRoute
     * @param CacheTagInterface[] $tags
     */
    public function linkRouteToTags(CacheRouteInterface $cacheRoute, array $tags): void;

}