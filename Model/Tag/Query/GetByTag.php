<?php
/**
 * Created by PhpStorm.
 * User: utietze
 * Date: 10.02.19
 * Time: 01:09
 */

namespace Firegento\Model\Tag\Query;


use Firegento\CacheWarmup\Api\Data\CacheTagInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterfaceFactory;
use Magento\Framework\Api\SimpleDataObjectConverter;
use Magento\Framework\App\ResourceConnection;

class GetByTag
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

    public function execute(string $tag):? CacheTagInterface
    {
        $connection = $this->resourceConnection->getConnection();

        $dbRoute = array_pop($connection
            ->select()
            ->from('cache_tags')
            ->where('cache_tag = ?', $tag)
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