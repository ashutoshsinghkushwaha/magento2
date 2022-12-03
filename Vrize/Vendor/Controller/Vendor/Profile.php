<?php

namespace Vrize\Vendor\Controller\Vendor;

class Profile extends \Magento\Framework\App\Action\Action
{
    /** @var PageFactory */
    protected $resultPageFactory;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Construct
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        $this->logger = $logger;
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
