<?php
namespace Testimonial\Module\Api\Data;

interface ViewInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID                     = 'id';
    const IMAGE                  = 'image';
    const NAME                   = 'name';
    const EMAIL                  = 'email';
    const REMARKS                = 'remarks';
    const SCORE                  = 'score';
    const CREATED_AT             = 'created_at';

    /**
     * Set Title
     *
     * @param string $getId
     * @return $this
     */
    public function getId();

   

    /**
     * Get getImage
     *
     * @return string|null
     */
    public function getImage();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getName();

     /**
     * Get getEmail
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getRemarks();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getScore();

    /**
     * Get Created At
     *
     * @return string|null
     */
     
    public function getCreatedAt();

    /**
     * Get ID
     *
     * @return int|null
     */
   
    
    public function setId($id);
    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */

    public function setImage($title);

    /**
     * Set Content
     *
     * @param string $content
     * @return $this
     */
    public function setName($content);

     /**
     * Set Content
     *
     * @param string $content
     * @return $this
     */
    public function setEmail($content);


    /**
     * Set Crated At
     *
     * @param int $createdAt
     * @return $this
     */

    public function setRemarks($content);

    /**
     * Set Crated At
     *
     * @param int $createdAt
     * @return $this
     */
    public function setScore($content);

    /**
     * Set Crated At
     *
     * @param int $createdAt
     * @return $this
     */

    public function setCreatedAt($createdAt);

    
}