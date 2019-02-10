<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\Route\Query;

use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;
use Magento\Framework\App\ResourceConnection;

class SaveRoute
{
    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    public function __construct(ResourceConnection $resourceConnection)
    {
        $this->resourceConnection = $resourceConnection;
    }

    public function execute(CacheRouteInterface $cacheRoute): void
    {
        $connection = $this->resourceConnection->getConnection();

        $connection->insertOnDuplicate(
            'cache_routes',
            [
                'route'         => $cacheRoute->getRoute(),
                'cache_status'  => $cacheRoute->getCacheStatus() ? 1 : 0,
                'popularity'    => $cacheRoute->getPopularity(),
                'lifetime'      => $cacheRoute->getLifetime()
            ],
            ['cache_status', 'popularity', 'lifetime']
        );

    }
}