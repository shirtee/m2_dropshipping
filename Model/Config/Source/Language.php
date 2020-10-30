<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\Config\Source;

class Language implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'de', 'label' => __('DE')],
            ['value' => 'en', 'label' => __('EN')]
        ];
    }
}
