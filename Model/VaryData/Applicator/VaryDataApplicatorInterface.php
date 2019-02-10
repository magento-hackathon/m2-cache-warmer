<?php
declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\VaryData\Applicator;

interface VaryDataApplicatorInterface
{
    public function apply(array $varyData): void;
}
