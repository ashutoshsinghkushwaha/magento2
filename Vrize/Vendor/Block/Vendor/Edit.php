<?php
namespace Vrize\Vendor\Block\Vendor;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Request\Http;
use Magento\Customer\Model\CustomerFactory;

class Edit extends Template
{
    /**
     * Construct
     *
     * @param Context $context
     * @param CustomerFactory $customerFactory
     * @param Http $request
     * @param array $data
     */
    public function __construct(
        Context $context,
        CustomerFactory $customerFactory,
        Http $request,
        array $data = []
    ) {
        $this->customerFactory = $customerFactory;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    /**
     * Get user data
     *
     * @return user Object
     */
    public function getUserData()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->customerFactory->create();
        $userData = $model->load($id);
        return $userData;
    }

    /**
     * Form Action
     *
     * @return Url
     */
    public function getFormAction()
    {
        return $this->getUrl('vendor/user/save', ['_secure' => true]);
    }

    /**
     * Form Action
     *
     * @return Url
     */
    public function getCancleAction()
    {
        return $this->getUrl('vendor/role', ['_secure' => true]);
    }
}
