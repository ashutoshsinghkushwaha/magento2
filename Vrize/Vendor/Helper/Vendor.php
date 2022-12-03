<?php
namespace Vrize\Vendor\Helper;

class Vendor extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Currently logged in customer
     *
     * @var \Magento\Customer\Api\Data\CustomerInterface
     */
    protected $_currentCustomer;

    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Vrize\Vendor\Model\ResourceModel\Resources\CollectionFactory $resourceFactory
     * @param \Vrize\Vendor\Model\ResourceModel\UserRole\CollectionFactory $userRoleCollection
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Vrize\Vendor\Model\ResourceModel\Resources\CollectionFactory $resourceFactory,
        \Vrize\Vendor\Model\ResourceModel\UserRole\CollectionFactory $userRoleCollection
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_customerSession = $customerSession;
        $this->_storeManager = $storeManager;
        $this->urlBuilder = $urlBuilder;
        $this->resourceFactory = $resourceFactory;
        $this->userRoleCollection = $userRoleCollection;
        parent::__construct($context);
    }

    /**
     * Retrive customer login status
     *
     * @return bool
     */
    public function _isCustomerLogIn()
    {
        return $this->_customerSession->isLoggedIn();
    }

    /**
     * Retrive logged in customer
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface
     */
    protected function _getCurrentCustomer()
    {
        return $this->getCustomer();
    }

    /**
     * Retrieve current customer
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface|null
     */
    public function getCustomer()
    {
        if (!$this->_currentCustomer && $this->_isCustomerLogIn()) {
            $this->_currentCustomer = $this->_customerSession->getCustomerDataObject();
        }
        return $this->_currentCustomer;
    }

    /**
     *  Check is vendor section allowed in sidebar
     *
     * @return bool
     */
    public function isVendorInfoAllowedInSidebar()
    {
        if ($this->isAVendorAndAccountApproved()) {
            return true;
        }
        return false;
    }

    /**
     * Check if customer is a vendor and account is approved
     */
    public function isAVendorAndAccountApproved()
    {
        $this->_currentCustomer = $this->getCustomer();
        $isVendor = $this->_currentCustomer->getCustomAttribute('is_vendor')->getValue();
        $isApprovedAccount = $this->_currentCustomer->getCustomAttribute('approve_account')->getValue();

        if ($isVendor && $isApprovedAccount) {
            return true;
        }
        return false;
    }

    /**
     *  Return vendor profile url
     *
     * @return mixed
     */
    public function getVendorProfileUrl()
    {
        return $this->urlBuilder->getUrl('vendor/vendor/profile');
    }

    /**
     * Check customer role
     */
    public function checkUserRole()
    {
        $collection = $this->userRoleCollection->create()->addFieldToSelect('role_id')
        ->addFieldToFilter('user_id', $this->_customerSession->getCustomerId())->load()->getData();
        if (count($collection) > 0) {
            return $collection[0]['role_id'];
        }
        return '';
    }

    /**
     * Get role collection
     */
    public function getRoleCollection()
    {
        $loggedUserRole = $this->checkUserRole();
        $collection = $this->resourceFactory->create()->addFieldToSelect('resource_id')
        ->addFieldToFilter('role_id', $loggedUserRole)->addFieldToFilter('permission', 'allow')->load()->getData();
        return $collection;
    }

    /**
     * Check if customer allow resource
     *
     * @param var $role
     */
    public function checkAllowAccess($role)
    {
        $resource = [];
        $loggedUserRole = $this->checkUserRole();
        $collection = $this->resourceFactory->create()->addFieldToSelect('resource_id')
        ->addFieldToFilter('role_id', $loggedUserRole)->addFieldToFilter('permission', 'allow')->load()->getData();
        foreach ($collection as $activeResource) {
            $resource[] = $activeResource['resource_id'];
        }
        if (in_array($role, $resource) || $this->isAVendor()) {
            return true;
        }
        return false;
    }

    /**
     * Check if customer is a vendor
     */
    public function isAVendor()
    {
        $this->_currentCustomer = $this->getCustomer();
        $isVendor = $this->_currentCustomer->getCustomAttribute('seller_parent_id')->getValue();
        if ($isVendor > 0) {
            return false;
        }
        return true;
    }
}
