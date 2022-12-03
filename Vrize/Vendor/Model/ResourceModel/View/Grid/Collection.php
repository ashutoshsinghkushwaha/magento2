<?php
   
namespace Vrize\Vendor\Model\ResourceModel\View\Grid;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Search\AggregationInterface;
use Vrize\Vendor\Model\ResourceModel\View\Collection as GridCollection;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Collection extends GridCollection implements SearchResultInterface
{
    /**
     * Construct.
     *
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $eventManager
     * @param StoreManagerInterface $storeManager
     * @param AbstractDb $resource
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        $mainTable,
        $eventPrefix,
        $eventObject,
        $resourceModel,
        $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
        $connection = null,
        AbstractDb $resource = null
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $storeManager,
            $connection,
            $resource
        );
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
    }

    /**
     * Get Aggregation
     *
     * @param var $data
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * Get Aggregation
     *
     * @param var $aggregations
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * Get Aggregation
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Get Aggregation
     *
     * @param SearchCriteriaInterface $searchCriteria
     */
    public function setSearchCriteria(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ) {
        return $this;
    }
    
    /**
     * Get Aggregation
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }
  
    /**
     * Set Total count
     *
     * @param var $totalCount
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }
   
    /**
     * Get Aggregation
     *
     * @param array $items
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}
