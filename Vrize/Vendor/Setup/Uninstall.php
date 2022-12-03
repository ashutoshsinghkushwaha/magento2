<?php

namespace Vrize\Vendor\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements \Magento\Framework\Setup\UninstallInterface
{
    /** @var EavSetupFactory */
    protected $eavSetupFactory;

    /**
     * Construct
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Uninstall
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        /**
         * product attributes
         */
        $entityTypeId = 4;
        $eavSetup->removeAttribute($entityTypeId, 'vendor_id');
        /**
         * customer attributes
         */
        $entityTypeId = 1;
        $eavSetup->removeAttribute($entityTypeId, 'is_vendor');
        $eavSetup->removeAttribute($entityTypeId, 'approve_account');
        $setup->endSetup();
    }
}
