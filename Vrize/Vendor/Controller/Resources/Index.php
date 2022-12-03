<?php
namespace Vrize\Vendor\Controller\Resources;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Customer\Model\CustomerFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var PageFactory */
    protected $_pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Session $session
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\Session $session
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_session = $session;
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
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('Assign Resources To Role');
        return $resultPage;
    }
}
