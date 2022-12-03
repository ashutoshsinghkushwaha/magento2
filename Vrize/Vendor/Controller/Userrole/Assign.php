<?php
namespace Vrize\Vendor\Controller\Userrole;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Vrize\Vendor\Model\SaveUserRole;
use Psr\Log\LoggerInterface;

class Assign extends Action
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
     * @param Context $context
     */

    /**
     * @var saveUserRole
     */
    protected $saveUserRole;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveUserRole $saveUserRole
     * @param LoggerInterface $logger
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        SaveUserRole $saveUserRole,
        LoggerInterface $logger
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->context = $context;
        $this->saveUserRole = $saveUserRole;
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
            $this->messageManager->addSuccessMessage(
                __('User Role has been updated.')
            );
            $post = $this->getRequest()->getPost();
            $this->saveUserRole->createUserRole($post);
            $this->dataPersistor->clear('apply_here');
            return $this->resultRedirectFactory->create()->setPath('vendor/user');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('apply_here', $this->getRequest()->getParams());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('apply_here', $this->getRequest()->getParams());
        }
        if (!empty($post['id'])) {
            return $this->resultRedirectFactory->create()->setPath('vendor/user');
        }
        return $this->resultRedirectFactory->create()->setPath('vendor/user');
    }
}
