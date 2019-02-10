<?php
/**
 * Created by PhpStorm.
 * User: utietze
 * Date: 10.02.19
 * Time: 14:40
 */

namespace Firegento\CacheWarmup\Service\Route;


use Firegento\CacheWarmup\Api\CacheRouteRepositoryInterface;
use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;

class GetExistingOrNewRouteModel
{
    /**
     * @var CacheRouteRepositoryInterface
     */
    protected $cacheRouteRepository;
    /**
     * @var NewRouteModelProvider
     */
    protected $newRouteModelProvider;

    public function __construct(
        CacheRouteRepositoryInterface $cacheRouteRepository,
        NewRouteModelProvider $newRouteModelProvider
    ) {
        $this->cacheRouteRepository = $cacheRouteRepository;
        $this->newRouteModelProvider = $newRouteModelProvider;
    }

    public function getByRoute(string $route): CacheRouteInterface
    {
        $routeModel = $this->cacheRouteRepository->getByRoute($route);

        if (!$routeModel) {
            $routeModel = $this->newRouteModelProvider->createForRoute($route);
            $this->cacheRouteRepository->save($routeModel);
            $routeModel = $this->cacheRouteRepository->getByRoute($route);
        }

        return $routeModel;
    }
}