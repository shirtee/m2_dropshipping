<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\CronProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'scpid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\CronProduct::class, \Shirtee\Dropshipping\Model\ResourceModel\CronProduct::class);
    }
}
