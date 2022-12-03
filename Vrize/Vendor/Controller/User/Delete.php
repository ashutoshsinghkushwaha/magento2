<?php
namespace Vrize\Vendor\Controller\User;

use Vrize\Vendor\Helper\Vendor;
 
class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
     protected $_pageFactory;
     /**
      * @var Http
      */
     protected $_request;
     /**
      * @var CustomerFactory
      */
     protected $_customerFactory;
     /**
      * @var RedirectFactory
      */
     protected $resultRedirectFactory;
     /**
      * @var Registry
      */
     protected $registry;
     
     /**
      * @param Context $context
      * @param PageFactory $pageFactory
      * @param Http $request
      * @param CustomerFactory $customerFactory
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
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\Session $session,
        Vendor $helperVendor
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->_customerFactory = $customerFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->registry = $registry;
        $this->_session = $session;
        $this->helperVendor = $helperVendor;
        $registry->register('isSecureArea', true);
        return parent::__construct($context);
    }
     
     /**
      * Delete customer
      *
      * @return void
      * @SuppressWarnings(PHPMD.CyclomaticComplexity)
      * @SuppressWarnings(PHPMD.NPathComplexity)
      */
    public function execute()
    {
        if (!$this->_session->isLoggedIn()) {
            $this->_redirect('customer/account/login');
            return;
        }
        if (!$this->helperVendor->checkAllowAccess('delete_user')) {
            $this->_redirect('vendor/user');
            return;
        }
        try {
            $this->messageManager->addSuccessMessage(
                __('User has been deleted.')
            );
            $resultRedirect = $this->resultRedirectFactory->create();
            $id = $this->getRequest()->getParam('id');
            $model = $this->_customerFactory->create();
            $userData = $model->load($id);
            $userData->delete();
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
        }
        return $resultRedirect->setPath('vendor/user');
    }
}
