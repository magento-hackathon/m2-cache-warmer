<?php
declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\VaryData\Query;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Serialize\SerializerInterface;

class SaveVaryData
{
    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(ResourceConnection $resourceConnection, SerializerInterface $serializer)
    {
        $this->resourceConnection = $resourceConnection;
        $this->serializer = $serializer;
    }

    public function execute(array $varyData): void
    {
        $connection = $this->resourceConnection->getConnection();
        $connection->insertOnDuplicate(
            'cache_vary_data',
            ['vary_data' => $this->serializer->serialize($varyData)],
            ['vary_data']
        );
    }
}
