<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api\Data;

interface CacheRouteInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return mixed
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @param string $route
     * @return mixed
     */
    public function setRoute(string $route): void;

    /**
     * @return bool
     */
    public function getCacheStatus(): bool;

    /**
     * @param int|bool $cacheStatus
     * @return mixed
     */
    public function setCacheStatus($cacheStatus): void;

    /**
     * @return int
     */
    public function getLifetime(): int;

    /**
     * @param int $lifetime
     * @return mixed
     */
    public function setLifetime(int $lifetime): void;
}