<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model;

class ProductRule extends \Magento\Framework\Model\AbstractModel
{
    const ENTITY = 'shirtee_product_rules';

    protected function _construct()
    {
        $this->_init(\Shirtee\Dropshipping\Model\ResourceModel\ProductRule::class);
    }
}
