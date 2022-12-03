<?php

namespace Vrize\Vendor\Controller\Products;

class Manage extends \Magento\Framework\App\Action\Action
{
    /** @var PageFactory */
    protected $resultPageFactory;

    /**
     * Construct
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
