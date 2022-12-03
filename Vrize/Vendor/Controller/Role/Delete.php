<?php
namespace Vrize\Vendor\Controller\Role;

use Vrize\Vendor\Helper\Vendor;
 
class Delete extends \Magento\Framework\App\Action\Action
{
     /** @var PageFactory */
     protected $_pageFactory;

     /** @var Http */
     protected $_request;

     /** @var RoleFactory */
     protected $_saveRole;

     /** @var RedirectFactory */
     protected $resultRedirectFactory;

     /** @var Registry */
     protected $registry;

     /**
      * @param Context $context
      * @param PageFactory $pageFactory
      * @param Http $request
      * @param RoleFactory $saveRole
      * @param RedirectFactory $resultRedirectFactory
      * @param Registry $registry
      * @param Session $session
      * @param Vendor $helperVendor
      *
      * @SuppressWarnings(PHPMD.ExcessiveParameterList)
      */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Request\Http $request,
        \Vrize\Vendor\Model\RoleFactory $saveRole,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\Session $session,
        Vendor $helperVendor
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->_saveRole = $saveRole;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->registry = $registry;
        $this->_session = $session;
        $this->helperVendor = $helperVendor;
        $registry->register('isSecureArea', true);
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
        if (!$this->helperVendor->checkAllowAccess('delete_role')) {
            $this->_redirect('vendor/role');
            return;
        }
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->_saveRole->create();
        $data = $resultRedirect->setRoleId($id);
        $data->delete();
        $this->messageManager->addSuccessMessage(
            __('Role has been deleted.')
        );
        return $this->_redirect('vendor/role');
    }
}
