<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\CronModifyProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'scmpid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\CronModifyProduct::class, \Shirtee\Dropshipping\Model\ResourceModel\CronModifyProduct::class);
    }
}
