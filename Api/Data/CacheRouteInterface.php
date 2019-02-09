<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Api\Data;

interface CacheRouteInterface
{
    /**
     * @return int
     */
    public function getId():? int;

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void;

    /**
     * @return string
     */
    public function getRoute():? string;

    /**
     * @param string $route
     * @return void
     */
    public function setRoute(string $route): void;

    /**
     * @return bool
     */
    public function getCacheStatus():? bool;

    /**
     * @param int|bool $cacheStatus
     * @return void
     */
    public function setCacheStatus($cacheStatus): void;

    /**
     * @return int
     */
    public function getLifetime():? int;

    /**
     * @param int $lifetime
     * @return void
     */
    public function setLifetime(int $lifetime): void;

    /**
     * @return int
     */
    public function getPopularity():? int;

    /**
     * @param int $popularity
     * @return void
     */
    public function setPopularity(int $popularity): void;
}