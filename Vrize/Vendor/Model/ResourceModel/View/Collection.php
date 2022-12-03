<?php

namespace Vrize\Vendor\Model\ResourceModel\View;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var $_idFieldName
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Construct
     *
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $eventManager
     * @param StoreManagerInterface $storeManager
     * @param AdapterInterface $connection
     * @param AbstractDb $resource
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        $this->_init(\Vrize\Vendor\Model\View::class, \Vrize\Vendor\Model\ResourceModel\View::class);
        
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }
    /**
     * Data provider
     */
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
            ['secondTable' => $this->getTable('customer_address_entity')],
            'main_table.entity_id = secondTable.parent_id'
        )->joinInner(
            ['thirdTable' => $this->getTable('customer_entity_int')],
            'main_table.entity_id = thirdTable.entity_id and thirdTable.attribute_id = 
            (select attribute_id from eav_attribute where attribute_code 
            = \'is_vendor\') and thirdTable.value =1'
        )->joinInner(
            ['fifthTable' => $this->getTable('customer_entity_int')],
            'main_table.entity_id = fifthTable.entity_id and fifthTable.attribute_id = 
            (select attribute_id from eav_attribute where attribute_code 
            = \'seller_parent_id\') and fifthTable.value =0'
        )->joinInner(
            ['fourthTable' => $this->getTable('customer_entity_int')],
            'main_table.entity_id = fourthTable.entity_id and fourthTable.attribute_id = 
            (select attribute_id from eav_attribute where attribute_code = \'approve_account\')',
            ['main_table.entity_id','main_table.email','main_table.firstname',
            'secondTable.telephone','fourthTable.value']
        );

        $this->addFilterToMap('firstname', 'main_table.firstname');
        $this->addFilterToMap('email', 'main_table.email');
        $this->addFilterToMap('telephone', 'secondTable.telephone');
        $this->addFilterToMap('entity_id', 'main_table.entity_id');
        $this->addFilterToMap('value', 'fourthTable.value');
    }
}
