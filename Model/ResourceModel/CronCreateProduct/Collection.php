<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\CronCreateProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'sccpid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\CronCreateProduct::class, \Shirtee\Dropshipping\Model\ResourceModel\CronCreateProduct::class);
    }
}
