<?php

namespace Testimonial\Module\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \Testimonial\Module\Api\Data\ViewInterface;

/**
 * Class File
 * @package Testimonial\Module\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class View extends AbstractModel implements ViewInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'thecoachsmb_mymodule_view';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Testimonial\Module\Model\ResourceModel\View');
    }


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getRemarks()
    {
        return $this->getData(self::REMARKS);
    }


    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function getScore()
    {
        return $this->getData(self::SCORE);
    }


    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Return identities
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setRemarks($remark)
    {
        return $this->setData(self::REMARKS, $remark);
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setScore($score)
    {
        return $this->setData(self::SCORE, $score);
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

      /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

      /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

   
}