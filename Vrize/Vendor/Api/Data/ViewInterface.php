<?php
namespace Vrize\Vendor\Api\Data;

interface ViewInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    public const ENTITY_ID     = 'entity_id';
    public const FIRSTNAME     = 'firstname';
    public const EMAIL         = 'email';
    public const TELEPHONE     = 'telephone';
    public const ISACTIVE      = 'is_active';

    /**#@-*/
    /**
     * Get Title
     *
     * @return string|null
     */
    public function getFirstname();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get Created At
     *
     * @return string|null
     */
    
    public function getTelephone();

    /**
     * Get Firstname
     *
     * @param string $firstname
     * @return int|null
     */

    public function setFirstname($firstname);

    /**
     * Set Email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * Set Crated At
     *
     * @param int $telephone
     * @return $this
     */
    public function setTelephone($telephone);

    /**
     * Set ID
     *
     * @param int $entity_id
     * @return $this
     */

    public function setEntityId($entity_id);
}
