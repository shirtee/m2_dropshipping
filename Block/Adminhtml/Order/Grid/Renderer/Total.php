<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml\Order\Grid\Renderer;

class Total extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    public function render(\Magento\Framework\DataObject $row)
    {
        $total = $row->getOrderTotal()." ".$row->getOrderCurrency();
        return $total;
    }
}
