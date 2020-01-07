<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml\Order\Grid\Renderer;

class Tracking extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    public function render(\Magento\Framework\DataObject $row)
    {
        $tracking = $row->getTrackingCompany()." - ".$row->getTrackingNumber();
        return $tracking;
    }
}
