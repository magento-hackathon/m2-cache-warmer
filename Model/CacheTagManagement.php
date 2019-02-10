<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model;


use Firegento\CacheWarmup\Api\CacheTagManagementInterface;
use Firegento\CacheWarmup\Model\Tag\Management\InvalidateRoutesByTags;

class CacheTagManagement implements CacheTagManagementInterface
{
    /**
     * @var InvalidateRoutesByTags
     */
    protected $invalidateRoutesByTags;

    public function __construct(
        InvalidateRoutesByTags $invalidateRoutesByTags
    ) {
        $this->invalidateRoutesByTags = $invalidateRoutesByTags;
    }

    /**
     * @param string[] $tags
     */
    public function invalidateRoutesByTags(array $tags): void
    {
        $this->invalidateRoutesByTags->execute($tags);
    }
}
