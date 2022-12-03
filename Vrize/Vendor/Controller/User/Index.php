<?php
namespace Vrize\Vendor\Controller\User;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Customer\Model\CustomerFactory;
use Vrize\Vendor\Helper\Vendor;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var PageFactory */
    protected $_pageFactory;

    /** @var Customer */
    protected $_customer;

    /** @var CustomerFactory */
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
        Vendor $helperVendor
    ) {
        $this->_pageFactory = $pageFactory;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->_customerFactory = $customerFactory;
        $this->_customer = $customers;
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
        if (!$this->helperVendor->checkAllowAccess('list_user')) {
            $this->_redirect('vendor/vendor/profile');
                return;
        }
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('User List');
        return $resultPage;
    }
}
