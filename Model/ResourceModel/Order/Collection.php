<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'oid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\Order::class, \Shirtee\Dropshipping\Model\ResourceModel\Order::class);
    }
}
