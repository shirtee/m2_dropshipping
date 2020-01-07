<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model;

class CronProduct extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'shirtee_cron_product';
    
    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ResourceModel\CronProduct::class);
    }
}
