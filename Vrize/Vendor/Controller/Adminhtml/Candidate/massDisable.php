<?php
namespace Vrize\Vendor\Controller\Adminhtml\Candidate;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Vrize\Vendor\Model\ResourceModel\View\CollectionFactory;

class MassDisable extends Action
{
    /** @var CollectionFactory */
    public $collectionFactory;

    /** @var Filter */
    public $filter;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ViewFactory $viewFactory
     * @param CustomerFactory $customerFactory
     * @param CustomerFactory $customerResouceFactory
     * @param Customer $customers
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Vrize\Vendor\Model\ViewFactory $viewFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\ResourceModel\CustomerFactory $customerResouceFactory,
        \Magento\Customer\Model\Customer $customers
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->viewFactory = $viewFactory;
        $this->_customerFactory = $customerFactory;
        $this->_customer = $customers;
        $this->_customerResouceFactory = $customerResouceFactory;
        parent::__construct($context);
    }

    /**
     * Prints the information
     *
     * @return Page
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;
            foreach ($collection as $model) {
                $model = $this->_customerFactory->create()->load($model->getEntityId());
                $customerData = $model->getDataModel();
                $customerData->setCustomAttribute('approve_account', 0);
                $model->updateData($customerData);
                $customerResource = $this->_customerResouceFactory->create();
                $customerResource->saveAttribute($model, 'approve_account');
                $count++;
            }
            $this->messageManager->addSuccess(
                __('A total of %1 Sellet(s) have been change status to Disapproved.', $count)
            );
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('seller/candidate/index');
    }
}
