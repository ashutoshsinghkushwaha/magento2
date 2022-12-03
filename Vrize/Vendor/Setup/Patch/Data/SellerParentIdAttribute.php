<?php

declare (strict_types = 1);

namespace Vrize\Vendor\Setup\Patch\Data;

use Magento\Catalog\Ui\DataProvider\Product\ProductCollectionFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Psr\Log\LoggerInterface;

class SellerParentIdAttribute implements DataPatchInterface, PatchRevertableInterface
{
   /**
    * @var ModuleDataSetupInterface
    */
    private $moduleDataSetup;

   /**
    * @var EavSetupFactory
    */
    private $eavSetupFactory;
   
   /**
    * @var ProductCollectionFactory
    */
    private $productCollectionFactory;
   
   /**
    * @var LoggerInterface
    */
    private $logger;
   
   /**
    * @var Config
    */
    private $eavConfig;
   
   /**
    * @var \Magento\Customer\Model\ResourceModel\Attribute
    */
    private $attributeResource;

   /**
    * SellerParentIdAttribute Constructor
    *
    * @param EavSetupFactory $eavSetupFactory
    * @param Config $eavConfig
    * @param LoggerInterface $logger
    * @param \Magento\Customer\Model\ResourceModel\Attribute $attributeResource
    * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig,
        LoggerInterface $logger,
        \Magento\Customer\Model\ResourceModel\Attribute $attributeResource,
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->logger = $logger;
        $this->attributeResource = $attributeResource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

   /**
    * Apply
    */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->addSellerPrantIdAttribute();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

   /**
    * Seller
    *
    * @throws \Magento\Framework\Exception\AlreadyExistsException
    * @throws \Magento\Framework\Exception\LocalizedException
    * @throws \Zend_Validate_Exception
    */
    public function addSellerPrantIdAttribute()
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'seller_parent_id',
            [
               'type' => 'int',
               'label' => 'Seller Parent Id',
               'input' => 'text',
               'required' => 0,
               'default' => 0,
               'visible' => false,
               'visible_on_front' => false,
               'user_defined' => 1,
               'sort_order' => 999,
               'position' => 999,
               'system' => 0
            ]
        );

        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);
        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'seller_parent_id');
        $attribute->setData('attribute_set_id', $attributeSetId);
        $attribute->setData('attribute_group_id', $attributeGroupId);
        $this->attributeResource->save($attribute);
    }

   /**
    * Dependency
    */
    public static function getDependencies()
    {
        return [];
    }

   /**
    * Revert
    */
    public function revert()
    {
        return '';
    }

   /**
    * Aliases
    */
    public function getAliases()
    {
        return [];
    }
}
