<?php
namespace Vrize\Vendor\Controller\User;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Vrize\Vendor\Model\SaveCustomer;
use Psr\Log\LoggerInterface;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Model\Url as CustomerUrl;
use Magento\Contract\Model\MailInterface;

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
     * @var UploaderFactory
     */
    protected $uploaderFactory;

    /**
     * @var AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var saveCustomer
     */
    protected $saveCustomer;

     /** @var AccountManagementInterface */
     protected $accountManagement;

     /** @var CustomerUrl */
    protected $customerUrl;



    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param SaveCustomer $saveCustomer
     * @param LoggerInterface $logger
     * @param AccountManagementInterface $accountManagement
     * @param CustomerUrl $customerUrl
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        SaveCustomer $saveCustomer,
        LoggerInterface $logger,
        AccountManagementInterface $accountManagement,
        CustomerUrl $customerUrl
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->context = $context;
        $this->saveCustomer = $saveCustomer;
        $this->logger = $logger;
        $this->accountManagement = $accountManagement;
        $this->customerUrl = $customerUrl;
        parent::__construct($context,$accountManagement,$customerUrl,);
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
            $id = $post['id'];

            //$customer = $this->accountManagement->createAccount($customer, $password, $redirectUrl);

            if ($this->saveCustomer->isAccountConfirmed($post['email'], $id)) {
                $this->saveCustomer->createCustomer($post);
                if ($id) {
                    $this->messageManager->addSuccessMessage(
                        __('User has been updated.')
                    );
                } else {
                    $this->messageManager->addSuccessMessage(
                        __('User has been created.')
                    );
                }
                $this->dataPersistor->clear('apply_here');
                return $this->resultRedirectFactory->create()->setPath('vendor/user');
            } else {
                $this->messageManager->addErrorMessage(__('User email already exists.'));
                $this->dataPersistor->set('apply_here', $this->getRequest()->getParams());
                return $this->resultRedirectFactory->create()->setPath('vendor/user/add');
            }

            $this->_eventManager->dispatch(
                'customer_register_success',
                ['account_controller' => $this, 'customer' => $customer]
            );
            $customer = $this->accountManagement->createAccount($customer,  $redirectUrl);

            $confirmationStatus = $this->accountManagement->getConfirmationStatus($customer->getId());
            if ($confirmationStatus === AccountManagementInterface::ACCOUNT_CONFIRMATION_REQUIRED) {
                $email = $this->customerUrl->getEmailConfirmationUrl($customer->getEmail());
                // @codingStandardsIgnoreStart
                $this->messageManager->addSuccess(
                    __(
                        'You must confirm your account. Please check your email for the confirmation link or <a href="%1">click here</a> for a new link.',
                        $email
                    )
                );
                // @codingStandardsIgnoreEnd
                $url = $this->urlModel->getUrl('*/*/index', ['_secure' => true]);
                $resultRedirect->setUrl($this->_redirect->success($url));
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
        if (!empty($post['id'])) {
            return $this->resultRedirectFactory->create()->setPath('vendor/user/edit/id/'.$data['id']);
        }
        return $this->resultRedirectFactory->create()->setPath('vendor/user/add');
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
        if (trim($request->getParam('name', '')) === '') {
            throw new LocalizedException(__('Enter the Name and try again.'));
        }
        if (trim($request->getParam('last_name', '')) === '') {
            throw new LocalizedException(__('Enter the Last Name and try again.'));
        }
        if (\strpos($request->getParam('email', ''), '@') === false) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        if (trim($request->getParam('hideit', '')) !== '') {
        // phpcs:ignore Magento2.Exceptions.DirectThrow
            throw new \Exception();
        }
        return $request->getParams();
    }
}
