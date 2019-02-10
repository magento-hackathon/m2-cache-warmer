<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\Route;

use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;

/**
 * Class CacheRoute
 * @package Firegento\CacheWarmup\Model\Route
 */
class CacheRoute implements CacheRouteInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $route;

    /**
     * @var bool
     */
    private $cacheStatus;

    /**
     * @var int
     */
    private $lifetime;

    /**
     * @var int
     */
    private $popularity;

    /**
     * @return int
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getRoute():? string
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return void
     */
    public function setRoute(string $route): void
    {
        $this->route = $route;
    }

    /**
     * @return bool
     */
    public function getCacheStatus():? bool
    {
        return $this->cacheStatus;
    }

    /**
     * @param int|bool $cacheStatus
     * @return void
     */
    public function setCacheStatus($cacheStatus): void
    {
        $this->cacheStatus = $cacheStatus;
    }

    /**
     * @return int
     */
    public function getLifetime():? int
    {
        return $this->lifetime;
    }

    /**
     * @param int $lifetime
     * @return void
     */
    public function setLifetime(int $lifetime): void
    {
        $this->lifetime = $lifetime;
    }

    /**
     * @return int
     */
    public function getPopularity():? int
    {
        return $this->popularity;
    }

    /**
     * @param int $popularity
     * @return void
     */
    public function setPopularity(int $popularity): void
    {
        $this->popularity = $popularity;
    }
}