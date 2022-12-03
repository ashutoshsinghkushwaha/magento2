<?php

namespace Testimonial\Module\Model;

class SavePost extends \Magento\Framework\View\Element\Template
{
    /**
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param ViewFactory $viewFactory
     * @param Session $customerSession
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Testimonial\Module\Model\ViewFactory $viewFactory,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->storeManager = $storeManager;
        $this->viewFactory = $viewFactory;
        $this->session = $customerSession;
        parent::__construct($context);
    }

    /**
     * Create record
     *
     * @param var $data
     */
    public function createRecord($data)
    { 
        if (!empty($data['id'])) {
            
            $postData = $this->viewFactory->create();
            $postData = $postData->setData($data);
            $postData->save();
        } else {

            $postData = $this->viewFactory->create();
            $postData = $postData->setData($data);
            $postData->save(); 
        }
    }
    /**
     * Check email
     *
     * @param var $email
     * @param int $id
     */
    public function checkEmailExist($email)
    {
        $email = $this->viewFactory->create()->getCollection()->addFieldToSelect('*')
        ->addFieldToFilter('email', $email)
        ->load()->getData();
        if (count($email)==0) {
            return true;
      
        } else {
            return false;
        }
    }
   
}