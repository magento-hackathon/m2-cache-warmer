<?php
declare(strict_types=1);

namespace Firegento\CacheWarmup\Api;

interface CacheVaryDataRepositoryInterface
{
    /**
     * @param array $varyData
     */
    public function save(array $varyData): void;

    /**
     * @return array[]
     */
    public function getAll(): array;
}
