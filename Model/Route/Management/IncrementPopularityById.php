<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\Route\Management;

use Magento\Framework\App\ResourceConnection;

class IncrementPopularityById
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

    public function execute(int $id): void
    {
        $connection = $this->resourceConnection->getConnection();

        $connection->update(
            'cache_routes',
            ['popularity' => new \Zend_Db_Expr('popularity + 1')],
            ['id' => $id]
        );
    }
}