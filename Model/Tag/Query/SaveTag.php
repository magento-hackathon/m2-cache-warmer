<?php

namespace Firegento\CacheWarmup\Model\Route\Query;

use Firegento\CacheWarmup\Api\Data\CacheTagInterface;
use Magento\Framework\App\ResourceConnection;

class SaveTag
{
    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    public function __construct(ResourceConnection $resourceConnection)
    {
        $this->resourceConnection = $resourceConnection;
    }

    public function execute(CacheTagInterface $cacheTag): void
    {
        $connection = $this->resourceConnection->getConnection();

        $connection->insert(
            'cache_routes',
            ['cache_tag' => $cacheTag->getCacheTag()]
        );
    }
}