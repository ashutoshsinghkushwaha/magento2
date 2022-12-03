<?php

namespace Vrize\Vendor\Model;

use Vrize\Vendor\Api\Data\ViewInterface;

class View extends \Magento\Framework\Model\AbstractModel implements ViewInterface
{
    /**
     * CMS page cache tag.
     */
    protected const CACHE_TAG = 'seller_menu_listing';

    /**
     * @var string
     */
    protected $_cacheTag = 'seller_menu_listing';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'seller_menu_listing';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(\Vrize\Vendor\Model\ResourceModel\View::class);
    }
    /**
     * Get EntityId.
     *
     * @return int
     */

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntityId.
     *
     * @param int $entityId
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get FirstName
     *
     * @return varchar
     */
    public function getFirstname()
    {
        return $this->setData(self::FIRSTNAME);
    }

    /**
     * Set EntityId
     *
     * @param var $firstname
     */
    public function setFirstname($firstname)
    {
        return $this->setData(self::FIRSTNAME, $firstname);
    }

    /**
     * Set Is Active
     */
    public function getIsActive()
    {
        return $this->setData(self::ISACTIVE);
    }

    /**
     * Set Telephone.
     *
     * @param var $telephone
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * Get Telephone
     */
    public function getTelephone()
    {
        return $this->setData(self::TELEPHONE);
    }

    /**
     * Set Is Active.
     *
     * @param var $isactive
     */
    public function setIsActive($isactive)
    {
        return $this->setData(self::ISACTIVE, $isactive);
    }

    /**
     * Get email.
     *
     * @return varchar
     */
    public function getEmail()
    {
        return $this->setData(self::EMAIL);
    }

    /**
     * Set Email.
     *
     * @param var $email
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set CreatedAt.
     *
     * @param var $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
