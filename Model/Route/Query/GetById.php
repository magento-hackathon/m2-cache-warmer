<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\Route\Query;

use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;
use Firegento\CacheWarmup\Api\Data\CacheRouteInterfaceFactory;
use Magento\Framework\Api\SimpleDataObjectConverter;
use Magento\Framework\App\ResourceConnection;

class GetById
{
    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;
    /**
     * @var CacheRouteInterfaceFactory
     */
    protected $cacheRouteFactory;

    public function __construct(
        ResourceConnection $resourceConnection,
        CacheRouteInterfaceFactory $cacheRouteFactory
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->cacheRouteFactory = $cacheRouteFactory;
    }

    public function execute($id):? CacheRouteInterface
    {
        $connection = $this->resourceConnection->getConnection();

        $dbRoute = array_pop($connection
            ->select()
            ->from('cache_routes')
            ->where('id = ?', $id)
            ->query()
            ->fetchAll()
        );

        if ($dbRoute) {
            /** @var CacheRouteInterface $cacheRoute */
            $cacheRoute = $this->cacheRouteFactory->create();

            array_walk($dbRoute, function ($value, $key) use ($cacheRoute) {
                $camelCaseKey = "set" . SimpleDataObjectConverter::snakeCaseToUpperCamelCase($key);
                $cacheRoute->$camelCaseKey($value);
            });
        }

        return $cacheRoute ?? null;
    }
}