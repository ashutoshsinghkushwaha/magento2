<?php
namespace Vrize\Vendor\Controller\Resources;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Customer\Model\CustomerFactory;

class Assign extends \Magento\Framework\App\Action\Action
{
    /** @var PageFactory */
    protected $_pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * Prints the information
     *
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->set('Assign Resources To Role');
        return $resultPage;
    }
}
