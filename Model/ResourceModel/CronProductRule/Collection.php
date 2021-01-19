<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\ResourceModel\CronProductRule;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'scprid';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\CronProductRule::class, \Shirtee\Dropshipping\Model\ResourceModel\CronProductRule::class);
    }
}
