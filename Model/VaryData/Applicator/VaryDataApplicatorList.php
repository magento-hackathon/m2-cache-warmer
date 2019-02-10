<?php
declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\VaryData\Applicator;

class VaryDataApplicatorList
{
    /**
     * @var VaryDataApplicatorInterface[]
     */
    private $varyDataApplicators;

    /**
     * VaryDataApplicatorList constructor.
     * @param VaryDataApplicatorInterface[] $varyDataApplicators
     */
    public function __construct(array $varyDataApplicators = [])
    {
        $this->varyDataApplicators = $varyDataApplicators;
    }

    public function applyAll(array $varyData): void
    {
        foreach ($this->varyDataApplicators as $varyDataApplicator) {
            $varyDataApplicator->apply($varyData);
        }
    }
}
