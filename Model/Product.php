<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model;

class Product extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'shirtee_products';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ResourceModel\Product::class);
    }
}
