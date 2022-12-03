<?php
namespace Testimonial\Module\Model\ResourceModel\View;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Testimonial\Module\Model\View::class, \Testimonial\Module\Model\ResourceModel\View::class);
    }
}