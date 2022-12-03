<?php

namespace Vrize\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
use Vrize\Vendor\Api\Data\RoleInterface;

class Role extends AbstractModel implements RoleInterface
{
    /**
     * Cache tag
     */
    public const CACHE_TAG = 'vrize_vendor_role';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(\Vrize\Vendor\Model\ResourceModel\Role::class);
    }

    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->getData(self::ROLE_ID);
    }

     /**
      * Set CreatedAt.

      * @return int
      * @param int $entityId
      */
    public function setRoleId($entityId)
    {
        return $this->setData(self::ROLE_ID, $entityId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getRoleName()
    {
        return $this->getData(self::ROLE_NAME);
    }

    /**
     * Set Title.
     *
     * @param var $rolename
     */
    public function setRoleName($rolename)
    {
        return $this->setData(self::ROLE_NAME, $rolename);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getVendorId()
    {
        return $this->getData(self::VENDOR_ID);
    }

    /**
     * Set Vendor Id.
     *
     * @param var $vendorId
     */
    public function setVendorId($vendorId)
    {
        return $this->setData(self::VENDOR_ID, $vendorId);
    }

    /**
     * Get CreatedAt.
     *
     * @param varchar
     */
    public function getAddedAt()
    {
        return $this->getData(self::ADDED_AT);
    }

    /**
     * Set CreatedAt.
     *
     * @param var $createdAt
     * @return varchar
     */
    public function setAddedAt($createdAt)
    {
        return $this->setData(self::ADDED_AT, $createdAt);
    }
}
