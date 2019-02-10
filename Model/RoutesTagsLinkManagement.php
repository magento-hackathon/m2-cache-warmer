<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model;


use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterface;
use Firegento\CacheWarmup\Api\RoutesTagsLinkManagementInterface;
use Firegento\CacheWarmup\Model\RoutesTagsLink\Management\LinkRouteToTags;

class RoutesTagsLinkManagement implements RoutesTagsLinkManagementInterface
{
    /**
     * @var LinkRouteToTags
     */
    protected $linkRouteToTags;

    public function __construct(
        LinkRouteToTags $linkRouteToTags
    ) {
        $this->linkRouteToTags = $linkRouteToTags;
    }

    /**
     * Take care, that this only works if both (route & tags) exists
     *
     * @param CacheRouteInterface $cacheRoute
     * @param CacheTagInterface[] $tags
     *
     * @throws \Zend_Db_Exception
     */
    public function linkRouteToTags(CacheRouteInterface $cacheRoute, array $tags): void
    {
        array_walk($tags, function (&$value) {return $value->getId();});
        $this->linkRouteToTags->execute($cacheRoute->getId(), $tags);
    }
}