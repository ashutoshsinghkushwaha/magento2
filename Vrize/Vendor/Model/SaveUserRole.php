<?php

namespace Vrize\Vendor\Model;

class SaveUserRole extends \Magento\Framework\View\Element\Template
{
    /**
     * Construct
     *
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param UserRoleFactory $userRoleFactory
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Vrize\Vendor\Model\UserRoleFactory $userRoleFactory,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->userRoleFactory = $userRoleFactory;
        $this->session = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * Create customer
     *
     * @param var $data
     */
    public function createUserRole($data)
    {
        $role = $this->userRoleFactory->create();
        if (!empty($data['id'])) {
            $role->load($data['id']);
            $role->setRoleId($data['role_id']);
            $role->save();
        } else {
            //For Assign Role to User
            $rolecheck = $this->userRoleFactory->create()->getCollection()
            ->addFieldToSelect("*")
            ->addFieldToFilter("user_id", ["eq" => $data['user_id']])
            ->load();
            if ($rolecheck->count()==0) {
                $role->setRoleId($data['role_id']);
                $role->setUserId($data['user_id']);
                $role->save();
            }
        }
    }
}
