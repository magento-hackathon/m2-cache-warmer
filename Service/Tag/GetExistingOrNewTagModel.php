<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Service\Tag;


use Firegento\CacheWarmup\Api\CacheTagRepositoryInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterface;

class GetExistingOrNewTagModel
{
    /**
     * @var CacheTagRepositoryInterface
     */
    protected $cacheTagRepository;
    /**
     * @var NewTagModelProvider
     */
    protected $newTagModelProvider;

    public function __construct(
        CacheTagRepositoryInterface $cacheTagRepository,
        NewTagModelProvider $newTagModelProvider
    ) {
        $this->cacheTagRepository  = $cacheTagRepository;
        $this->newTagModelProvider = $newTagModelProvider;
    }

    public function getByTag(string $cacheTag): CacheTagInterface
    {
        $cacheTag = $this->cacheTagRepository->getByTag($cacheTag);

        if (!$cacheTag) {
            $cacheTag = $this->newTagModelProvider->createForTag($cacheTag);
            $this->cacheTagRepository->save($cacheTag);
            $cacheTag = $this->cacheTagRepository->getByTag($cacheTag);
        }

        return $cacheTag;
    }
}