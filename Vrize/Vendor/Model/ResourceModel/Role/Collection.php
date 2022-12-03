<?php
namespace Vrize\Vendor\Model\ResourceModel\Role;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vrize\Vendor\Model\Role as Model;
use Vrize\Vendor\Model\ResourceModel\Role as ResourceModel;

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
