<?php
namespace Vrize\Vendor\Api\Data;

interface UserRoleInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    public const ID                = 'id';
    public const ROLE_ID           = 'role_id';
    public const USER_ID           = 'user_id';
    public const ADDED_AT          = 'added_at';

    /**#@-*/
    /**
     * Get Id
     *
     * @return string|null
     */
    public function getId();

    /**
     * Get Role Id
     *
     * @return string|null
     */
    public function getRoleId();

    /**
     * Get User Id
     *
     * @return string|null
     */
    
    public function getUserId();

    /**
     * Get Created At
     *
     * @return string|null
     */
    
    public function getAddedAt();

    /**
     * Set Id
     *
     * @param string $id
     * @return $this
     */
    public function setId($id);

    /**
     * Set roleName
     *
     * @param string $roleId
     * @return $this
     */
    public function setRoleId($roleId);

    /**
     * Set User Id
     *
     * @param int $userId
     * @return $this
     */
    public function setUserId($userId);

    /**
     * Created At
     *
     * @param int $createdAt
     * @return $this
     */

    public function setAddedAt($createdAt);
}
