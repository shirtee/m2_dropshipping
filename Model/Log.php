<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model;

class Log extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'shirtee_logs';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ResourceModel\Log::class);
    }
}
