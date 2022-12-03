<?php
namespace Vrize\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
use Vrize\Vendor\Api\Data\ResourcesInterface;

class Resources extends AbstractModel implements ResourcesInterface
{
    /**
     * Cache tag
     */
    public const CACHE_TAG = 'vrize_vendor_resources';
    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(\Vrize\Vendor\Model\ResourceModel\Resources::class);
    }

    /**
     * Get ruleId.
     *
     * @return int
     */
    public function getRuleId()
    {
        return $this->getData(self::RULE_ID);
    }

    /**
     * Set ruleId.
     *
     * @param int $ruleId
     */
    public function setRuleId($ruleId)
    {
        return $this->setData(self::RULE_ID, $ruleId);
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
     * Get resourceId.
     *
     * @return varchar
     */
    public function getResourceId()
    {
        return $this->getData(self::RESOURCE_ID);
    }

    /**
     * Set resourceId.
     *
     * @param var $resourceId
     */
    public function setResourceId($resourceId)
    {
        return $this->setData(self::RESOURCE_ID, $resourceId);
    }

    /**
     * Get permission.
     *
     * @return varchar
     */
    public function getPermission()
    {
        return $this->getData(self::PERMISSION);
    }

    /**
     * Set permission
     *
     * @param var $permission
     */
    public function setPermission($permission)
    {
        return $this->setData(self::PERMISSION, $permission);
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
     * Set CreatedAt
     *
     * @param var $createdAt
     */
    public function setAddedAt($createdAt)
    {
        return $this->setData(self::ADDED_AT, $createdAt);
    }
}
