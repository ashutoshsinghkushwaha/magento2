<?php
namespace Vrize\Vendor\Controller\User;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Controller\ResultFactory;
use Vrize\Vendor\Helper\Vendor;

class Edit extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    /**
     * @var Customer
     */
    protected $_customer;
    /**
     * @var CustomerFactory
     */
    protected $_customerFactory;
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param CustomerFactory $customerFactory
     * @param Customer $customers
     * @param Session $session
     * @param RedirectFactory $resultRedirectFactory
     * @param Vendor $helperVendor
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Customer $customers,
        \Magento\Customer\Model\Session $session,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        Vendor $helperVendor
    ) {
        $this->_pageFactory = $pageFactory;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->_customerFactory = $customerFactory;
        $this->_customer = $customers;
        $this->_session = $session;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->helperVendor = $helperVendor;
        return parent::__construct($context);
    }

    /**
     * Edit customer account action
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
        if (!$this->helperVendor->checkAllowAccess('edit_user')) {
            $this->_redirect('vendor/user');
            return;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        $model = $this->_customerFactory->create();
        $userData = $model->load($id);
        if (empty($userData->getId())===true) {
            return $resultRedirect->setPath('vendor/user');
        }
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set('Update User');
        return $resultPage;
    }
}
