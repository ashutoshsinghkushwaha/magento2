<?php
namespace Vrize\Vendor\Controller\Adminhtml\Candidate;

class Index extends \Magento\Backend\App\Action
{
    /** @var PageFactory */
    protected $_pageFactory;

    /**
     * Construct
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
         parent::__construct($context);
    }

    /**
     * Page
     */
    public function execute()
    {
          return $this->_pageFactory->create();
    }
}
