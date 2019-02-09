<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model;


use Firegento\CacheWarmup\Api\CacheTagRepositoryInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterfaceFactory;

class CacheTagRepository implements CacheTagRepositoryInterface
{
    /**
     * @var CacheTagInterfaceFactory
     */
    protected $cacheTagFactory;

    public function __construct(CacheTagInterfaceFactory $cacheTagFactory)
    {
        $this->cacheTagFactory = $cacheTagFactory;
    }

    public function getById(int $id):? CacheTagInterface
    {
        // TODO: May implement something with real data here

        /** @var CacheTagInterface $cacheTag */
        $cacheTag = $this->cacheTagFactory->create();
        $cacheTag->setId($id);
        $cacheTag->setCacheTag("saucooles_fancy_superproduct");

        return $cacheTag;
    }

    public function getByTag(string $cacheTag):? CacheTagInterface
    {
        // TODO: May implement something with real data here

        return $this->getById(rand(1,4000));
    }
}