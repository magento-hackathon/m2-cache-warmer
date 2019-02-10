<?php
declare(strict_types=1);

namespace Firegento\CacheWarmup\Model;

use Firegento\CacheWarmup\Api\CacheVaryDataRepositoryInterface;
use Firegento\CacheWarmup\Model\VaryData\Query\GetAllVaryData;
use Firegento\CacheWarmup\Model\VaryData\Query\SaveVaryData;

class CacheVaryDataRepository implements CacheVaryDataRepositoryInterface
{
    /**
     * @var SaveVaryData
     */
    private $saveVaryData;
    /**
     * @var GetAllVaryData
     */
    private $getAllVaryData;

    public function __construct(SaveVaryData $saveVaryData, GetAllVaryData $getAllVaryData)
    {
        $this->saveVaryData = $saveVaryData;
        $this->getAllVaryData = $getAllVaryData;
    }

    /**
     * @param array $varyData
     */
    public function save(array $varyData): void
    {
        $this->saveVaryData->execute($varyData);
    }

    /**
     * @return array[]
     */
    public function getAll(): array
    {
        return $this->getAllVaryData->execute();
    }
}
