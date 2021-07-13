<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\Config\Source;

class ProductStatus implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'active', 'label' => __('Active')],
            ['value' => 'draft', 'label' => __('Draft')]
        ];
    }
}
