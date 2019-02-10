<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api;

use Firegento\CacheWarmup\Api\Data\CacheTagInterface;

interface CacheTagRepositoryInterface
{
    public function getById(int $id):? CacheTagInterface;

    public function getByTag(string $tag):? CacheTagInterface;

    public function save(CacheTagInterface $cacheTag): void;
}