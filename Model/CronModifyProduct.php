<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model;

class CronModifyProduct extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'shirtee_cron_modify_product';
    
    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ResourceModel\CronModifyProduct::class);
    }
}
