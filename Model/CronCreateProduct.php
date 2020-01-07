<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model;

class CronCreateProduct extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'shirtee_cron_create_product';
    
    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ResourceModel\CronCreateProduct::class);
    }
}
