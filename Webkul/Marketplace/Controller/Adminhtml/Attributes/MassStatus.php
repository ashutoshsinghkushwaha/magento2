<?php
/**
 * @category  Webkul
 * @package   Webkul_Marketplace
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Webkul\Marketplace\Controller\Adminhtml\Attributes;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Webkul\Marketplace\Model\ResourceModel\VendorAttributeMapping\CollectionFactory;
use Magento\Framework\App\ResourceConnection;

/**
 * Class MassStatus used to update status.
 */
class MassStatus extends \Magento\Backend\App\Action
{
    /**
     * TABLE_NAME table name
     */
    public const TABLE_NAME = 'wk_mp_attr_mapping';
    /**
     * ENABLE_STATUS Enable Status Value
     */
    public const ENABLE_STATUS  = 1;
    /**
     * DISABLE_STATUS Disable Status Value
     */
    public const DISABLE_STATUS = 0;
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected $connection;

    /**
     * @var Magento\Framework\App\ResourceConnection
     */
    protected $resource;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    /**
     * COnstruct
     *
     * @param Context $context
     * @param Filter $filter
     * @param ResourceConnection $resource
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param CollectionFactory $collectionFactory
     * @param \Magento\Eav\Setup\EavSetup $eavSetup
     */
    public function __construct(
        Context $context,
        Filter $filter,
        ResourceConnection $resource,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        CollectionFactory $collectionFactory,
        \Magento\Eav\Setup\EavSetup $eavSetup
    ) {
        $this->filter = $filter;
        $this->connection = $resource->getConnection();
        $this->resource = $resource;
        $this->collectionFactory = $collectionFactory;
        $this->_date = $date;
        $this->eavSetup = $eavSetup;
        parent::__construct($context);
    }
    /**
     * Execute action.
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     *
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $attributeIds = $this->getRequest()->getParam('selected');
        $status = $this->getRequest()->getParam('status');
        // print_r($this->getRequest()->getParams());die;
        $countRecord = 0;
       
        foreach ($attributeIds as $id) {
            $this->eavSetup->updateAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                $id,
                'visible_to_seller',
                $status,
                null
            );
            $countRecord++;
        }
       
        $this->messageManager->addSuccess(
            __(
                'A total of %1 record(s) have been updated.',
                $countRecord
            )
        );

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }

    /**
     * Check Is allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Webkul_Marketplace::configattributes');
    }
}
