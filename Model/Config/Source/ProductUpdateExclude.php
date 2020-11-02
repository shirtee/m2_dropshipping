<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\Config\Source;

class ProductUpdateExclude implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'no', 'label' => __('No')],
            ['value' => 'name', 'label' => __('Name')],
            ['value' => 'short_description', 'label' => __('Short Description')],
            ['value' => 'description', 'label' => __('Description')],
            ['value' => 'images', 'label' => __('Images')],
            ['value' => 'meta_title', 'label' => __('Meta Title')],
            ['value' => 'meta_description', 'label' => __('Meta Description')],
            ['value' => 'meta_keyword', 'label' => __('Meta Keyword')]
        ];
    }
}
