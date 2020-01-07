<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model;

class CronRemoveProduct extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'shirtee_cron_remove_product';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ResourceModel\CronRemoveProduct::class);
    }
}
