<?php

namespace Vrize\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
use Vrize\Vendor\Api\Data\UserRoleInterface;

class UserRole extends AbstractModel implements UserRoleInterface
{
    /**
     * Cache tag
     */
    public const CACHE_TAG = 'vrize_vendor_userrole';
    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(\Vrize\Vendor\Model\ResourceModel\UserRole::class);
    }
    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set EntityId.
     *
     * @param int $id
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
    /**
     * Get roleId.
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->getData(self::ROLE_ID);
    }

    /**
     * Set roleId.
     *
     * @param int $roleId
     */
    public function setRoleId($roleId)
    {
        return $this->setData(self::ROLE_ID, $roleId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getUserId()
    {
        return $this->getData(self::USER_ID);
    }

    /**
     * Set Title.
     *
     * @param int $userId
     */
    public function setUserId($userId)
    {
        return $this->setData(self::USER_ID, $userId);
    }

    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getAddedAt()
    {
        return $this->getData(self::ADDED_AT);
    }

    /**
     * Set CreatedAt.
     *
     * @param var $createdAt
     */
    public function setAddedAt($createdAt)
    {
        return $this->setData(self::ADDED_AT, $createdAt);
    }
}
