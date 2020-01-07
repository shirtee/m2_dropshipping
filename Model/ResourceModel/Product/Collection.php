<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\Product;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'pid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\Product::class, \Shirtee\Dropshipping\Model\ResourceModel\Product::class);
    }
}
