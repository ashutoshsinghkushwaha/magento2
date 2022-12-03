<?php
 
namespace Testimonial\Module\Block;
 
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Testimonial\Module\Model\ResourceModel\View\CollectionFactory;
 
class Index extends Template
{
    public $collection;
 
    public function __construct(
        Context $context, 
        CollectionFactory $collectionFactory, 
        array $data = []
        )
    {
        $this->collection = $collectionFactory;
        parent::__construct($context, $data);
    }
 
    public function getCollection()
    {
        return $this->collection->create();
    }


 
}