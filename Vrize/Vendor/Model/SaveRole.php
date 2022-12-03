<?php

namespace Vrize\Vendor\Model;

class SaveRole extends \Magento\Framework\View\Element\Template
{
    /**
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param RoleFactory $roleFactory
     * @param Session $customerSession
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Vrize\Vendor\Model\RoleFactory $roleFactory,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->storeManager = $storeManager;
        $this->roleFactory = $roleFactory;
        $this->session = $customerSession;
        parent::__construct($context);
    }

    /**
     * Create role
     *
     * @param var $data
     */
    public function createRole($data)
    {
        $role = $this->roleFactory->create();
        if (!empty($data['role_id'])) {
            $role->load($data['role_id']);
            $role->setRoleName($data['role_name']);
            $role->save();

        } else {
            //For Create new role
            $role->setRolename($data['role_name']);
            $role->setVendorId($this->session->getCustomerId());
            $role->save();
        }
    }

    /**
     * Check role
     *
     * @param var $roleName
     * @param int $id
     */
    public function isRoleConfirmed($roleName, $id)
    {
        $role = $this->roleFactory->create()->getCollection()->addFieldToSelect('*')
        ->addFieldToFilter('role_name', $roleName)
        ->addFieldToFilter('vendor_id', $this->session->getCustomerId())
        ->load()->getData();
        if (count($role)==0) {
            return true;
        } elseif ($role[0]['role_id'] == $id) {
            return true;
        } else {
            return false;
        }
    }
}
