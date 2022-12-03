<?php
namespace Vrize\Vendor\Api\Data;

interface RoleInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    public const ROLE_ID                = 'role_id';
    public const ROLE_NAME              = 'role_name';
    public const VENDOR_ID              = 'vendor_id';
    public const ADDED_AT               = 'added_at';

    /**#@-*/
    /**
     * Get Role Id
     *
     * @return string|null
     */
    public function getRoleId();

    /**
     * Get Role Name
     *
     * @return string|null
     */
    public function getRoleName();

    /**
     * Get Vendor Id
     *
     * @return string|null
     */
    
    public function getVendorId();

    /**
     * Get Created At
     *
     * @return string|null
     */
    
    public function getAddedAt();

    /**
     * Set Role Id
     *
     * @param string $roleId
     * @return $this
     */
    public function setRoleId($roleId);

    /**
     * Set roleName
     *
     * @param string $roleName
     * @return $this
     */
    public function setRoleName($roleName);

    /**
     * Set Vendor Id
     *
     * @param int $vendorId
     * @return $this
     */
    public function setVendorId($vendorId);

    /**
     * Created At
     *
     * @param int $createdAt
     * @return $this
     */

    public function setAddedAt($createdAt);
}
