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
            ['value' => 'en', 'label' => __('EN')],
            ['value' => 'dk', 'label' => __('DA')],
            ['value' => 'es', 'label' => __('ES')],
            ['value' => 'fin', 'label' => __('FI')],
            ['value' => 'fr', 'label' => __('FR')],
            ['value' => 'it', 'label' => __('IT')],
            ['value' => 'nl', 'label' => __('NL')],
            ['value' => 'nor', 'label' => __('NB')],
            ['value' => 'pl', 'label' => __('PL')],
            ['value' => 'pt', 'label' => __('PT')],
            ['value' => 'swe', 'label' => __('SV')]
        ];
    }
}
