<?php
namespace Vrize\Vendor\Api\Data;

interface ResourcesInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    public const RULE_ID        = 'rule_id';
    public const ROLE_ID        = 'role_id';
    public const RESOURCE_ID    = 'resource_id';
    public const PERMISSION     = 'permission';
    public const ADDED_AT       = 'added_at';

    /**#@-*/
    /**
     * Get Rule Id
     *
     * @return string|null
     */
    public function getRuleId();
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
    public function getResourceId();

    /**
     * Get Vendor Id
     *
     * @return string|null
     */
    
    public function getPermission();

    /**
     * Get Created At
     *
     * @return string|null
     */
    
    public function getAddedAt();

    /**
     * Set Rule Id
     *
     * @param string $ruleId
     * @return $this
     */
    public function setRuleId($ruleId);
    /**
     * Set Role Id
     *
     * @param string $roleId
     * @return $this
     */
    public function setRoleId($roleId);

    /**
     * Set resourceId
     *
     * @param string $resourceId
     * @return $this
     */
    public function setResourceId($resourceId);

    /**
     * Set permission
     *
     * @param int $permission
     * @return $this
     */
    public function setPermission($permission);

    /**
     * Created At
     *
     * @param int $createdAt
     * @return $this
     */
    
    public function setAddedAt($createdAt);
}
