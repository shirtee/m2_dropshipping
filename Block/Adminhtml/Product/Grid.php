<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml\Product;

class Grid extends \Magento\Backend\Block\Widget\Grid
{
    public function getCollection()
    {
        $website = $this->getParam("website");
        return $this->getData('dataSource')->addFieldToFilter("website_id", $website);
    }
}
