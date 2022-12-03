<?php
namespace Vrize\Vendor\Controller\Role;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Vrize\Vendor\Model\SaveRole;
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
     * @var saveRole
     */
    protected $saveRole;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveRole $saveRole
     * @param LoggerInterface $logger
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        SaveRole $saveRole,
        LoggerInterface $logger
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->context = $context;
        $this->saveRole = $saveRole;
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
            $data = $this->validatedParams();
            $post = $this->getRequest()->getPost();
            $id = $post['role_id'];
            if ($this->saveRole->isRoleConfirmed($post['role_name'], $id)) {
                $this->saveRole->createRole($post);
                if (!empty($post['role_id'])) {
                    $this->messageManager->addSuccessMessage(
                        __('Role Updated successfully')
                    );
                } else {
                    $this->messageManager->addSuccessMessage(
                        __('Role Added successfully')
                    );
                }
                $this->dataPersistor->clear('apply_here');
                return $this->resultRedirectFactory->create()->setPath('vendor/role');
            } else {
                $this->messageManager->addErrorMessage(__('Role already exists.'));
                $this->dataPersistor->set('apply_here', $this->getRequest()->getParams());
                return $this->resultRedirectFactory->create()->setPath('vendor/role/add');
            }
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
        if (!empty($post['role_id'])) {
            return $this->resultRedirectFactory->create()->setPath('vendor/role/edit/id/'.$data['role_id']);
        }
        return $this->resultRedirectFactory->create()->setPath('vendor/role/add');
    }

    /**
     * Method to validated params.
     *
     * @return array
     * @throws \Exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('role_name', '')) === '') {
            throw new LocalizedException(__('Enter the Role Name and try again.'));
        }
        return $request->getParams();
    }
}
