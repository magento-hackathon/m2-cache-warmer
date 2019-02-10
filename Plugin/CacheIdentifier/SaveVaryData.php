<?php
declare(strict_types=1);
/**
 * SaveVaryData
 *
 * @copyright Copyright © 2019 brandung GmbH & Co. KG. All rights reserved.
 * @author    david.verholen@brandung.de
 */

namespace Firegento\CacheWarmup\Plugin\CacheIdentifier;

use Firegento\CacheWarmup\Api\CacheVaryDataRepositoryInterface;
use Magento\Framework\App\Http\Context;

class SaveVaryData
{
    /**
     * @var Context
     */
    private $httpContext;
    /**
     * @var CacheVaryDataRepositoryInterface
     */
    private $varyDataRepository;

    public function __construct(Context $httpContext, CacheVaryDataRepositoryInterface $varyDataRepository)
    {
        $this->httpContext = $httpContext;
        $this->varyDataRepository = $varyDataRepository;
    }

    /**
     * Adds a theme key to identifier for a built-in cache if user-agent theme rule is actual
     *
     * @param \Magento\Framework\App\PageCache\Identifier $identifier
     * @param string $result
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetValue(\Magento\Framework\App\PageCache\Identifier $identifier, $result): string
    {
        $varyData = $this->httpContext->toArray()['data'];
        $this->varyDataRepository->save($varyData);
        return $result;
    }
}
