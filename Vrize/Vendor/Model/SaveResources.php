<?php

namespace Vrize\Vendor\Model;

class SaveResources extends \Magento\Framework\View\Element\Template
{
    /**
     * Construct
     *
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param ResourcesFactory $resourcesFactory
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Vrize\Vendor\Model\ResourcesFactory $resourcesFactory,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->storeManager = $storeManager;
        $this->resourcesFactory = $resourcesFactory;
        $this->session = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * Create Resource
     *
     * @param var $data
     */
    public function createResources($data)
    {
        $newArr = $data['resource'];
        if (empty($newArr)) {
            $data['resource'] = [];
        }
        $collections = $this->resourcesFactory->create()->getCollection()
                ->addFieldToFilter('role_id', $data['role_id']);
        foreach ($collections as $item) {
            if (in_array($item->getResourceId(), $data['resource'])) {
                $key = array_search($item->getResourceId(), $data['resource']);
                unset($newArr[$key]);
                $item->setPermission('allow');
            } else {
                $item->setPermission('deny');
            }
            $item->save();
        }
        if (!empty($newArr)) {
            foreach ($newArr as $newResource) {
                $resources = $this->resourcesFactory->create();
                $resources->setRoleId($data['role_id']);
                $resources->setResourceId($newResource);
                $resources->setPermission('allow');
                $resources->save();
            }
        }
    }
}
