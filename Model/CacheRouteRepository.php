<?php declare(strict_types=1);


namespace Firegento\CacheWarmup\Model;

use Firegento\CacheWarmup\Api\CacheRouteRepositoryInterface;
use Firegento\CacheWarmup\Api\Data\CacheRouteInterface;
use Firegento\CacheWarmup\Model\Route\Query\GetById;
use Firegento\CacheWarmup\Model\Route\Query\GetByRoute;
use Firegento\CacheWarmup\Model\Route\Query\SaveRoute;

class CacheRouteRepository implements CacheRouteRepositoryInterface
{

    /**
     * @var GetById
     */
    protected $getByIdQuery;
    /**
     * @var SaveRoute
     */
    protected $saveCommand;
    /**
     * @var GetByRoute
     */
    protected $getByRoute;

    public function __construct(
        GetById    $getByIdQuery,
        GetByRoute $getByRoute,
        SaveRoute  $saveCommand
    ) {
        $this->getByIdQuery = $getByIdQuery;
        $this->getByRoute   = $getByRoute;
        $this->saveCommand  = $saveCommand;
    }

    public function getById(int $id):? CacheRouteInterface
    {
        return $this->getByIdQuery->execute($id);
    }

    public function getByRoute(string $route):? CacheRouteInterface
    {
        return $this->getByRoute->execute($route);
    }

    public function save(CacheRouteInterface $cacheRoute): void
    {
        $this->saveCommand->execute($cacheRoute);
    }
}