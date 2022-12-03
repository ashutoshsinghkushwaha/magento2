<?php

namespace Vrize\Vendor\Model;

class SaveCustomer extends \Magento\Framework\View\Element\Template
{
    /**
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param CustomerFactory $customerFactory
     * @param GroupRepositoryInterface $groupRepository
     * @param Collection $customerCollectionFactory
     * @param Session $customerSession
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Api\GroupRepositoryInterface $groupRepository,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerCollectionFactory,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->storeManager = $storeManager;
        $this->customerFactory = $customerFactory;
        $this->groupRepository = $groupRepository;
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->session = $customerSession;
        parent::__construct($context);
    }

    /**
     * Create customer
     *
     * @param var $data
     */
    public function createCustomer($data)
    {
        $customer = $this->customerFactory->create();
        if (!empty($data['id'])) {
            $customer->load($data['id']);
            $customer->setFirstname($data['name'])
            ->setLastname($data['last_name'])
            ->setEmail($data['email']);
            $customer->save();
        } else {
            $store = $this->storeManager->getStore();
            $storeId = $store->getStoreId();
            $websiteId = $this->storeManager->getStore()->getWebsiteId();
            $customer->setWebsiteId($websiteId);
            $customer->loadByEmail($data['email']);// load customer by email address
            $groupId = $this->getGroupCode('Seller');
            if (!$customer->getId()) {
                //For guest customer create new cusotmer
                $customer->setWebsiteId($websiteId)
                ->setStore($store)
                ->setFirstname($data['name'])
                ->setLastname($data['last_name'])
                ->setEmail($data['email'])
                ->setIsVendor(1)
                ->setApproveAccount(1)
                ->setGroupId($groupId)
                ->setSellerParentId($this->session->getCustomerId());
                $customer->save();
            }
        }
    }

    /**
     * Prints the information
     *
     * @param var $groupName
     * @return Page
     */
    public function getGroupCode($groupName)
    {
        $groupList = $this->customerCollectionFactory->toOptionArray();
        foreach ($groupList as $group) {
            if ($group['label']==$groupName) {
                return $group['value'];
            }
        }
        foreach ($groupList as $group) {
            if ($group['label']=='General') {
                return $group['value'];
            }
        }
    }

    /**
     * Prints the information
     *
     * @param var $email
     * @param var $id
     * @return bool
     */
    public function isAccountConfirmed($email, $id)
    {
        $customer = $this->customerFactory->create();
        $store = $this->storeManager->getStore();
        $storeId = $store->getStoreId();
        $websiteId = $this->storeManager->getStore()->getWebsiteId();
        $customer->setWebsiteId($websiteId);
        $customer->loadByEmail($email);// load customer by email address
        if (!$customer->getId()) {
            return true;
        } elseif ($customer->getId() == $id) {
            return true;
        } else {
            return false;
        }
    }
}
