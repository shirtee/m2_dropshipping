<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model;

class Order extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'shirtee_orders';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ResourceModel\Order::class);
    }
}
