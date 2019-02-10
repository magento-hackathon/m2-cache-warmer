<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\RoutesTagsLink\Management;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\Pdo\Mysql;

class LinkRouteToTags
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
     * @param int $routeId
     * @param int[] $tagIds
     * @throws \Zend_Db_Exception
     */
    public function execute(int $routeId, array $tagIds): void
    {
        $routeToTags = [];
        array_walk($tagIds, function ($tagId) use ($routeId, $routeToTags) {
            $routeToTags[] = [
                'tag_id'   => $tagId,
                'route_id' => $routeId
            ];
        });

        /** @var Mysql $connection */
        $connection = $this->resourceConnection->getConnection();
        $connection->insertArray(
            'cache_routes_tags',
            ['route_id', 'tag_id'],
            $routeToTags,
            $connection::INSERT_IGNORE
        );
    }
}