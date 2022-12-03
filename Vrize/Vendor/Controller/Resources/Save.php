<?php
namespace Vrize\Vendor\Controller\Resources;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Vrize\Vendor\Model\SaveResources;
use Psr\Log\LoggerInterface;

class Save extends Action
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var saveResources
     */
    protected $saveResources;

    /**
     * @param Context $context
     * @param SaveResources $saveResources
     * @param LoggerInterface $logger
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        SaveResources $saveResources,
        LoggerInterface $logger
    ) {
        $this->context = $context;
        $this->saveResources = $saveResources;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Prints the information
     *
     * @return Page
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $post = $this->getRequest()->getPost();
            $this->saveResources->createResources($post);
            $this->messageManager->addSuccessMessage(
                __('Assign rules')
            );
            return $this->resultRedirectFactory->create()->setPath('vendor/role');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your Rule. Please try again later.')
            );
        }
    }
}
