<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\Tag\Query;

use Firegento\CacheWarmup\Api\Data\CacheTagInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterfaceFactory;
use Magento\Framework\Api\SimpleDataObjectConverter;
use Magento\Framework\App\ResourceConnection;

class GetById
{
    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;
    /**
     * @var CacheTagInterfaceFactory
     */
    protected $cacheTagFactory;

    public function __construct(
        ResourceConnection $resourceConnection,
        CacheTagInterfaceFactory $cacheTagFactory
    ) {
        $this->resourceConnection = $resourceConnection;
        $this->cacheTagFactory = $cacheTagFactory;
    }

    public function execute(int $id):? CacheTagInterface
    {
        $connection = $this->resourceConnection->getConnection();

        $dbRoute = array_pop($connection
            ->select()
            ->from('cache_tags')
            ->where('id = ?', $id)
            ->query()
            ->fetchAll()
        );

        if ($dbRoute) {
            /** @var CacheTagInterface $cacheTag */
            $cacheRoute = $this->cacheTagFactory->create();

            array_walk($dbRoute, function ($value, $key) use ($cacheRoute) {
                $camelCaseKey = "set" . SimpleDataObjectConverter::snakeCaseToUpperCamelCase($key);
                $cacheRoute->$camelCaseKey($value);
            });
        }

        return $cacheRoute ?? null;
    }
}