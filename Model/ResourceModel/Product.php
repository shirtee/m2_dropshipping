<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel;

class Product extends \Magento\Framework\Model\ResourceModel\Db\VersionControl\AbstractDb
{
    protected function _construct()
    {
        $this->_init('shirtee_products', 'pid');
    }

    protected function _initUniqueFields()
    {
        $this->_uniqueFields = [['field' => 'sku', 'title' => __('Shirtee SKU')]];
        return $this;
    }
}
