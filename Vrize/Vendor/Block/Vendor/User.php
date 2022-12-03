<?php
namespace Vrize\Vendor\Block\Vendor;

use Magento\Framework\View\Element\Template\Context;

class User extends \Magento\Framework\View\Element\Template
{
    /**
     * @param CustomerFactory $customerFactory
     * @param Customer $customers
     * @param AddressFactory $addressFactory
     * @param Session $customerSession
     * @param Role $role
     * @param RoleFactory $roleFactory
     * @param UserRoleFactory $userRole
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Customer $customers,
        \Magento\Customer\Model\AddressFactory $addressFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Vrize\Vendor\Model\Role $role,
        \Vrize\Vendor\Model\RoleFactory $roleFactory,
        \Vrize\Vendor\Model\UserRoleFactory $userRole,
        Context $context,
        array $data
    ) {
        $this->_customerFactory = $customerFactory;
        $this->_customer = $customers;
        $this->_addressFactory = $addressFactory;
        $this->session = $customerSession;
        $this->_role = $role;
        $this->_roleFactory = $roleFactory;
        $this->_userRole = $userRole;
        parent::__construct($context, $data);
    }

    /**
     * Get Collection
     */
    public function getCustomerCollection()
    {
        return $this->_customer->getCollection()
            ->addAttributeToSelect("*")
            ->addAttributeToFilter("is_vendor", ["eq" => '1'])
            ->addAttributeToFilter('seller_parent_id', ["eq" => $this->session->getCustomerId()])
            ->load();
    }

    /**
     * Form Address
     *
     * @param int $id
     * @return string
     */
    public function getDefaultAddress($id)
    {
        $customer = $this->_customerFactory->create()->load($id);
        $billingAddressId = $customer->getDefaultBilling();
        $billingAddress = $this->_addressFactory->create()->load($billingAddressId);
        return $billingAddress->getTelephone();
    }

    /**
     * Get Collection
     */
    public function getCustomerRole()
    {
        return $this->_roleFactory->create()->getCollection()
        ->addFieldToFilter("vendor_id", ["eq" => $this->session->getCustomerId()])->getData();
    }

    /**
     * Get Collection
     */
    public function getFormAction()
    {
        return $this->getUrl('vendor/userrole/assign', ['_secure' => true]);
    }

    /**
     * Get Collection
     *
     * @param int $id
     */
    public function getMappingId($id)
    {
        $mapping = $this->_userRole->create()->getCollection()
        ->addFieldToSelect("*")
        ->addFieldToFilter("user_id", ["eq" => $id])
        ->load();
        return $mapping->getFirstItem();
    }

    /**
     * Get Collection
     *
     * @param int $id
     */
    public function getRoleName($id)
    {
        $mapping = $this->_roleFactory->create()->load($id);
        return $mapping->getRoleName();
    }
}
