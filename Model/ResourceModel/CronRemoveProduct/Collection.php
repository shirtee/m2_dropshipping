<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\CronRemoveProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'scrpid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\CronRemoveProduct::class, \Shirtee\Dropshipping\Model\ResourceModel\CronRemoveProduct::class);
    }
}
