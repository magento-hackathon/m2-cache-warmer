<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api\Data;

interface CacheTagInterface
{
    /**
     * @return int
     */
    public function getId():? int;

    /**
     * @param int $id
     * @return mixed
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getCacheTag():? string;

    /**
     * @param string $cacheTag
     * @return mixed
     */
    public function setCacheTag(string $cacheTag): void;
}