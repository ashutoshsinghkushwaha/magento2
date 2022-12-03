<?php
namespace Vrize\Vendor\Block\Vendor\Role;

use Magento\Framework\View\Element\Template\Context;
use Vrize\Vendor\Model\ResourceModel\Role\CollectionFactory;
use Magento\Customer\Model\Session;

class Role extends \Magento\Framework\View\Element\Template
{
    /**
     * Construct
     *
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Session $customerSession,
        array $data
    ) {
        $this->collection = $collectionFactory;
        $this->session = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * Collection
     */
    public function getCollection()
    {
        $collection = $this->collection->create();
        return $collection->addFieldToFilter('vendor_id', $this->session->getCustomerId());
    }
}
