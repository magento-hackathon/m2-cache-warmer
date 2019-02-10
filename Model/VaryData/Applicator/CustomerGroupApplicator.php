<?php
declare(strict_types=1);

namespace Firegento\CacheWarmup\Model\VaryData\Applicator;

use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\Session;

class CustomerGroupApplicator implements VaryDataApplicatorInterface
{
    private const VARY_DATA_KEY = 'customer_group';

    /**
     * @var Session
     */
    private $customerSession;
    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    public function __construct(Session $customerSession, CustomerFactory $customerFactory)
    {
        $this->customerSession = $customerSession;
        $this->customerFactory = $customerFactory;
    }

    public function apply(array $varyData): void
    {
        $this->customerSession->clearStorage();
        $customerGroupId = $varyData[self::VARY_DATA_KEY];
        $customer = $this->customerFactory->create()->setGroupId($customerGroupId);
        $this->customerSession->setCustomerGroupId($customerGroupId);
        $this->customerSession->setCustomer($customer);
    }
}
