<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\Tag\Management;

use Magento\Framework\App\ResourceConnection;

class InvalidateRoutesByTags
{
    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @param string[] $tags
     */
    public function execute(array $tags): void
    {
        $connection = $this->resourceConnection->getConnection();

        $routesSql = $connection
            ->select()
            ->from(["crt" => 'cache_routes_tags'], ['id' => 'route_id'])
            ->joinLeft(
                ['ct' => 'cache_tags'],
                "crt.tag_id = ct.id",
                ['tag_id' => 'id']
            )->where('ct.tag in (?)', $tags)->__toString();

        $connection->update(
            'cache_routes',
            ['cache_status' => 0],
            ['id IN (?)' => $routesSql]
        );
    }
}