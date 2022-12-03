<?php
namespace Vrize\Vendor\Model\ResourceModel\UserRole;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vrize\Vendor\Model\UserRole as Model;
use Vrize\Vendor\Model\ResourceModel\UserRole as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
