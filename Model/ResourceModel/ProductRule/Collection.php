<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\ProductRule;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'sprid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ProductRule::class, \Shirtee\Dropshipping\Model\ResourceModel\ProductRule::class);
    }
}
