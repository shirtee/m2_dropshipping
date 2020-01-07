<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        //Is Shirtee Product?
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'is_shirtee');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'is_shirtee',
            [
                'backend' => '',
                'group' => 'Shirtee',
                'label' => 'Is Shirtee Product?',
                'input' => 'boolean',
                'type' => 'int',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'apply_to' => 'simple,virtual,configurable',
                'visible_on_front' => false,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'used_in_product_listing' => true,
                'searchable' => false,
                'visible_in_advanced_search' => false,
                'comparable' => false,
                'filterable' => false,
                'filterable_in_search' => false,
                'used_for_promo_rules' => true,
                'position' => 1
            ]
        );

        //Shirtee Color
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'shirtee_color');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'shirtee_color',
            [
                'group' => 'Shirtee',
                'label' => "Color",
                'input' => "select",
                'type' => "int",
                'global' => true,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'apply_to' => 'simple,virtual,configurable',
                'visible_on_front' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'used_in_product_listing' => true,
                'searchable' => true,
                'visible_in_advanced_search' => true,
                'comparable' => true,
                'filterable' => true,
                'filterable_in_search' => true,
                'used_for_promo_rules' => true,
                'position' => 2
            ]
        );

        //Shirtee Size
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'shirtee_size');
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'shirtee_size',
            [
                'group' => 'Shirtee',
                'label' => "Size",
                'input' => "select",
                'type' => "int",
                'global' => true,
                'visible' => true,
                'required' => false,
                'user_defined' => true,
                'apply_to' => 'simple,virtual,configurable',
                'visible_on_front' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'used_in_product_listing' => true,
                'searchable' => true,
                'visible_in_advanced_search' => true,
                'comparable' => true,
                'filterable' => true,
                'filterable_in_search' => true,
                'used_for_promo_rules' => true,
                'position' => 3
            ]
        );
    }
}
