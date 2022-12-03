<?php
 
namespace Vrize\Vendor\Controller\Role;

use Vrize\Vendor\Helper\Vendor;
 
class Edit extends \Magento\Framework\App\Action\Action
{
     /** @var PageFactory */
     protected $_pageFactory;

     /** @var Http */
     protected $_request;

     /** @var Registry */
     protected $_coreRegistry;
 
     /**
      * @param Context $context
      * @param PageFactory $pageFactory
      * @param Http $request
      * @param Registry $coreRegistry
      * @param Session $session
      * @param Vendor $helperVendor
      *
      * @SuppressWarnings(PHPMD.ExcessiveParameterList)
      */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Customer\Model\Session $session,
        Vendor $helperVendor
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->_coreRegistry = $coreRegistry;
        $this->_session = $session;
        $this->helperVendor = $helperVendor;
        return parent::__construct($context);
    }
 
    /**
     * Prints the information
     *
     * @return Page
     */
    public function execute()
    {
        if (!$this->_session->isLoggedIn()) {
            $this->_redirect('customer/account/login');
            return;
        }
        if (!$this->helperVendor->checkAllowAccess('edit_role')) {
             $this->_redirect('vendor/role');
             return;
        }
        $id = $this->_request->getParam('id');
        $this->_coreRegistry->register('role_id', $id);
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('Update Role');
        return $resultPage;
    }
}
