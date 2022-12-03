<?php
namespace Vrize\Vendor\Controller\Role;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Customer\Model\CustomerFactory;
use Vrize\Vendor\Helper\Vendor;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var PageFactory */
    protected $_pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Session $session
     * @param Vendor $helperVendor
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\Session $session,
        Vendor $helperVendor
    ) {
        $this->_pageFactory = $pageFactory;
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
        if (!$this->helperVendor->checkAllowAccess('list_role')) {
            $this->_redirect('vendor/vendor/profile');
                return;
        }
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('Manage Role');
        return $resultPage;
    }
}
