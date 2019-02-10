<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Service\Tag;


use Firegento\CacheWarmup\Api\Data\CacheTagInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterfaceFactory;

class NewTagModelProvider
{
    /**
     * @var CacheTagInterfaceFactory
     */
    protected $cacheTagInterfaceFactory;

    public function __construct(CacheTagInterfaceFactory $cacheTagInterfaceFactory)
    {
        $this->cacheTagInterfaceFactory = $cacheTagInterfaceFactory;
    }

    public function createForTag(string $cacheTag): CacheTagInterface
    {
        /** @var CacheTagInterface $tagModel */
        $tagModel = $this->cacheTagInterfaceFactory->create();
        $tagModel->setCacheTag($cacheTag);

        return $tagModel;
    }
}