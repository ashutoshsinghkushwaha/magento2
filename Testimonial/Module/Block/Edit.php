<?php
 
namespace Testimonial\Module\Block;
 
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Testimonial\Module\Model\ResourceModel\View\CollectionFactory;
use Testimonial\Module\Model\ViewFactory;
 
class Edit extends Template
{
    public $collection;
 
    public function __construct(
        Context $context, 
        CollectionFactory $collectionFactory, 
        ViewFactory $view,
        array $data = []
        )
    {
        $this->collection = $collectionFactory;
        $this->view = $view;
        parent::__construct($context, $data);
    }
    public function getFormAction()
    {
        return $this->getUrl('testimonial/index/post', ['_secure' => true]);
    }



    public function editOurData()
    {
        $editId = $this->getRequest()->getParam('id');
        $member = $this->view->create()->load($editId);
        return $member;
    }
  
}