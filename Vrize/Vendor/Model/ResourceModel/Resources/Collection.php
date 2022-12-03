<?php
namespace Vrize\Vendor\Model\ResourceModel\Resources;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vrize\Vendor\Model\Resources as Model;
use Vrize\Vendor\Model\ResourceModel\Resources as ResourceModel;

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
