<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    //Product tables
    const PRODUCT_TABLE = 'shirtee_products';
    const PRODUCT_RULE_TABLE = 'shirtee_product_rules';
    const CRON_PRODUCT_TABLE = 'shirtee_cron_product';
    const CRON_CREATE_PRODUCT_TABLE = 'shirtee_cron_create_product';
    const CRON_MODIFY_PRODUCT_TABLE = 'shirtee_cron_modify_product';
    const CRON_REMOVE_PRODUCT_TABLE = 'shirtee_cron_remove_product';
    const CRON_PRODUCT_RULE_TABLE = 'shirtee_cron_product_rules';

    //Order tables
    const ORDER_TABLE = 'shirtee_orders';

    //Log tables
    const LOG_TABLE = 'shirtee_logs';

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createTables($setup);
        $setup->endSetup();
    }

    private function createTables(SchemaSetupInterface $installer)
    {
        //Main product table
        $tableName = $installer->getTable(self::PRODUCT_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createProductTable($installer, self::PRODUCT_TABLE);

        //Product rule table
        $tableName = $installer->getTable(self::PRODUCT_RULE_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createProductRuleTable($installer, self::PRODUCT_RULE_TABLE);

        //Cron product table
        $tableName = $installer->getTable(self::CRON_PRODUCT_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createCronProductTable($installer, self::CRON_PRODUCT_TABLE);

        //Cron create product table
        $tableName = $installer->getTable(self::CRON_CREATE_PRODUCT_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createCronCreateProductTable($installer, self::CRON_CREATE_PRODUCT_TABLE);

        //Cron modify product table
        $tableName = $installer->getTable(self::CRON_MODIFY_PRODUCT_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createCronModifyProductTable($installer, self::CRON_MODIFY_PRODUCT_TABLE);

        //Cron remove product table
        $tableName = $installer->getTable(self::CRON_REMOVE_PRODUCT_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createCronRemoveProductTable($installer, self::CRON_REMOVE_PRODUCT_TABLE);

        //Cron product rule table
        $tableName = $installer->getTable(self::CRON_PRODUCT_RULE_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createCronProductRuleTable($installer, self::CRON_PRODUCT_RULE_TABLE);

        //Main order table
        $tableName = $installer->getTable(self::ORDER_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createOrderTable($installer, self::ORDER_TABLE);

        //Main log table
        $tableName = $installer->getTable(self::LOG_TABLE);
        $this->dropTableIfExists($installer, $tableName);
        $this->createLogTable($installer, self::LOG_TABLE);
    }

    private function dropTableIfExists($installer, $table)
    {
        $connection = $installer->getConnection();
        if ($connection->isTableExists($installer->getTable($table))) {
            $connection->dropTable(
                $installer->getTable($table)
            );
        }
    }

    private function createProductTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Product Table');

        $table
            ->addColumn(
                'pid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Product ID'
            )->addColumn(
                'shirtee_pid',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true
                ],
                'Shirtee Product ID'
            )->addColumn(
                'mage_pid',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true
                ],
                'Magento Product ID'
            )->addColumn(
                'category',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Shirtee Category Name'
            )->addColumn(
                'sku',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Shirtee SKU'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Shirtee Product Name'
            )->addColumn(
                'pdata',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Shirtee Product Data'
            )->addColumn(
                'options',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Shirtee Product Options'
            )->addColumn(
                'variations',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Shirtee Product Variations Count'
            )->addColumn(
                'images',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Shirtee Product Images'
            )->addColumn(
                'is_warehouse',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Warehouse Product?'
            )->addColumn(
                'is_alloverprint',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is AllOverPrint Product?'
            )->addColumn(
                'is_customize',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Customize Product?'
            )->addColumn(
                'is_cron_create',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Schedule For Create?'
            )->addColumn(
                'is_cron_modify',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Schedule For Modify?'
            )->addColumn(
                'is_cron_remove',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Schedule For Remove?'
            )->addColumn(
                'website_id',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Website ID'
            )->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Shirtee Product Status'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT_UPDATE
                ],
                'Update Time'
            )->addIndex(
                $setup->getIdxName($tableName, ['mage_pid']),
                ['mage_pid'],
                ['type' => \Magento\Framework\DB\Adapter\Pdo\Mysql::INDEX_TYPE_UNIQUE]
            );
        $setup->getConnection()->createTable($table);
    }

    private function createProductRuleTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Product Rule Table');

        $table
            ->addColumn(
                'sprid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Product Rule ID'
            )->addColumn(
                'sku',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Shirtee SKU'
            )->addColumn(
                'rule_type',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Shirtee Rule Type'
            )->addColumn(
                'size',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Shirtee Size'
            )->addColumn(
                'color',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Shirtee Color'
            )->addColumn(
                'color_ds',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Shirtee Color DS'
            )->addColumn(
                'shop_exclude',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Shirtee Designer ID Exclude'
            )->addColumn(
                'shop_only',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Shirtee Designer ID Only'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT_UPDATE
                ],
                'Update Time'
            );
        $setup->getConnection()->createTable($table);
    }

    private function createCronProductTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Cron Product Table');

        $table
            ->addColumn(
                'scpid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Cron ID'
            )->addColumn(
                'shirtee_pid',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true
                ],
                'Shirtee Product ID'
            )->addColumn(
                'website_id',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Website ID'
            )->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Cron Status'
            )->addColumn(
                'error',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Cron Error'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT_UPDATE
                ],
                'Update Time'
            );
        $setup->getConnection()->createTable($table);
    }

    private function createCronCreateProductTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Cron Create Product Table');

        $table
            ->addColumn(
                'sccpid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Cron ID'
            )->addColumn(
                'pid',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true
                ],
                'Product ID'
            )->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Cron Status'
            )->addColumn(
                'error',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Cron Error'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT_UPDATE
                ],
                'Update Time'
            )->addIndex(
                $setup->getIdxName($tableName, ['pid']),
                ['pid'],
                ['type' => \Magento\Framework\DB\Adapter\Pdo\Mysql::INDEX_TYPE_UNIQUE]
            );
        $setup->getConnection()->createTable($table);
    }

    private function createCronModifyProductTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Cron Modify Product Table');

        $table
            ->addColumn(
                'scmpid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Cron ID'
            )->addColumn(
                'pid',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true
                ],
                'Product ID'
            )->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Cron Status'
            )->addColumn(
                'error',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Cron Error'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT_UPDATE
                ],
                'Update Time'
            );
        $setup->getConnection()->createTable($table);
    }

    private function createCronRemoveProductTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Cron Remove Product Table');

        $table
            ->addColumn(
                'scrpid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Cron ID'
            )->addColumn(
                'pid',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true
                ],
                'Product ID'
            )->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Cron Status'
            )->addColumn(
                'error',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Cron Error'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT_UPDATE
                ],
                'Update Time'
            )->addIndex(
                $setup->getIdxName($tableName, ['pid']),
                ['pid'],
                ['type' => \Magento\Framework\DB\Adapter\Pdo\Mysql::INDEX_TYPE_UNIQUE]
            );
        $setup->getConnection()->createTable($table);
    }

    private function createCronProductRuleTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Cron Product Rule Table');

        $table
            ->addColumn(
                'scprid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Cron ID'
            )->addColumn(
                'pid',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true
                ],
                'Product ID'
            )->addColumn(
                'sku',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'SKU'
            )->addColumn(
                'rule_type',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Rule Type'
            )->addColumn(
                'size',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Size'
            )->addColumn(
                'color',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Color'
            )->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Cron Status'
            )->addColumn(
                'error',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Cron Error'
            )->addColumn(
                'full_log',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Full Log'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT_UPDATE
                ],
                'Update Time'
            );
        $setup->getConnection()->createTable($table);
    }

    private function createOrderTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Order Table');

        $table
            ->addColumn(
                'oid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Order ID'
            )->addColumn(
                'magento_oid',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Magento Order ID'
            )->addColumn(
                'order_date',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => true
                ],
                'Magento Order Date'
            )->addColumn(
                'order_email',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Magento Order Email'
            )->addColumn(
                'order_total',
                Table::TYPE_DECIMAL,
                '12,2',
                [
                    'nullable' => true
                ],
                'Magento Order Total'
            )->addColumn(
                'order_currency',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Magento Order Currency'
            )->addColumn(
                'order_status',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Magento Order Status'
            )->addColumn(
                'odata',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Magento Order Data'
            )->addColumn(
                'shirtee_oid',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Shirtee Order ID'
            )->addColumn(
                'shirtee_status',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Shirtee Order Status'
            )->addColumn(
                'is_fulfilled',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Order Fulfilled?'
            )->addColumn(
                'is_partial',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Partial Order?'
            )->addColumn(
                'is_sync_cloud',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Order Sync From Cloud?'
            )->addColumn(
                'is_warehouse',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Warehouse Order?'
            )->addColumn(
                'warehouse_items',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Warehouse Products'
            )->addColumn(
                'is_alloverprint',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is AllOverPrint Order?'
            )->addColumn(
                'alloverprint_items',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'AllOverPrint Products'
            )->addColumn(
                'is_customer',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Customer Order?'
            )->addColumn(
                'customer_items',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Customer Products'
            )->addColumn(
                'is_branding',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Branding Order?'
            )->addColumn(
                'branding_items',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Branding Products'
            )->addColumn(
                'is_return_order',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Return Order?'
            )->addColumn(
                'return_order_items',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Return Order Items'
            )->addColumn(
                'is_free_order',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Is Free Order?'
            )->addColumn(
                'free_order_items',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Free Order Items'
            )->addColumn(
                'tracking_date',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => true
                ],
                'Tracking Date'
            )->addColumn(
                'tracking_company',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Tracking Company'
            )->addColumn(
                'tracking_number',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Tracking Number'
            )->addColumn(
                'website_id',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Website ID'
            )->addColumn(
                'error',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Error'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT_UPDATE
                ],
                'Update Time'
            )->addIndex(
                $setup->getIdxName($tableName, ['magento_oid', 'shirtee_oid']),
                ['magento_oid', 'shirtee_oid'],
                ['type' => \Magento\Framework\DB\Adapter\Pdo\Mysql::INDEX_TYPE_UNIQUE]
            );
        $setup->getConnection()->createTable($table);
    }

    private function createLogTable(SchemaSetupInterface $setup, $tableName)
    {
        $table = $setup->getConnection()->newTable($tableName);
        $table->setComment('Shirtee Log Table');

        $table
            ->addColumn(
                'lid',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'nullable' => false,
                    'unsigned' => true,
                ],
                'Log ID'
            )->addColumn(
                'type',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Log Type'
            )->addColumn(
                'ldata',
                Table::TYPE_TEXT,
                null,
                [
                    'nullable' => true
                ],
                'Log Data'
            )->addColumn(
                'status',
                Table::TYPE_SMALLINT,
                null,
                [
                    'unsigned' => true,
                    'nullable' => true,
                    'default' => 0
                ],
                'Log Status'
            )->addColumn(
                'error',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable' => true
                ],
                'Log Error'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default' => Table::TIMESTAMP_INIT
                ],
                'Creation Time'
            );
        $setup->getConnection()->createTable($table);
    }
}
