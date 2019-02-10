<?php
declare(strict_types=1);
/**
 * GetAllVaryData
 *
 * @copyright Copyright © 2019 brandung GmbH & Co. KG. All rights reserved.
 * @author    david.verholen@brandung.de
 */

namespace Firegento\CacheWarmup\Model\VaryData\Query;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Serialize\SerializerInterface;

class GetAllVaryData
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

    /**
     * @return array[]
     */
    public function execute(): array
    {
        $connection = $this->resourceConnection->getConnection();
        return $connection->select()
            ->from('cache_vary_data')
            ->query()
            ->fetchAll();
    }
}
