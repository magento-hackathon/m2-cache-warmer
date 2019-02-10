<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api;

interface CacheTagManagementInterface
{
    /**
     * @param string[] $tags
     */
    public function invalidateRoutesByTags(array $tags): void;
}