<?php declare(strict_types=1);

namespace Firegento\CacheWarmup\Model;

use Firegento\CacheWarmup\Api\CacheTagRepositoryInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterface;
use Firegento\CacheWarmup\Api\Data\CacheTagInterfaceFactory;
use Firegento\CacheWarmup\Model\Tag\Query\GetById;
use Firegento\CacheWarmup\Model\Tag\Query\GetByTag;

class CacheTagRepository implements CacheTagRepositoryInterface
{

    /**
     * @var GetById
     */
    protected $getById;
    /**
     * @var GetByTag
     */
    protected $getByTag;

    public function __construct(
        GetById  $getById,
        GetByTag $getByTag
    ) {
        $this->getById  = $getById;
        $this->getByTag = $getByTag;
    }

    public function getById(int $id):? CacheTagInterface
    {
        return $this->getById->execute($id);
    }

    public function getByTag(string $cacheTag):? CacheTagInterface
    {
        return $this->getByTag->execute($cacheTag);
    }
}