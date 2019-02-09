<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\Tag;


use Firegento\CacheWarmup\Api\Data\CacheTagInterface;

/**
 * Class CacheTag
 * @package Firegento\CacheWarmup\Model\Tag
 */
class CacheTag implements CacheTagInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $cacheTag;

    /**
     * @return int
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCacheTag():? string
    {
        return $this->cacheTag;
    }

    /**
     * @param string $cacheTag
     * @return mixed
     */
    public function setCacheTag(string $cacheTag): void
    {
        $this->cacheTag = $cacheTag;
    }
}