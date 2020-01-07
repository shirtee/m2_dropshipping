<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Model\Config\Source;

class Website implements \Magento\Framework\Option\ArrayInterface
{
    public $websiteCollection;

    public function __construct(
        \Magento\Store\Model\ResourceModel\Website\CollectionFactory $websiteCollection
    ) {
        $this->websiteCollection = $websiteCollection;
    }

    public function toOptionArray()
    {
        return $this->websiteCollection->create()->toOptionArray();
    }
}
