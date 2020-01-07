<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\Log;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'lid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\Log::class, \Shirtee\Dropshipping\Model\ResourceModel\Log::class);
    }
}
