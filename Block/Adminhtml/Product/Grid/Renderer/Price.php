<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml\Product\Grid\Renderer;

class Price extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    public function __construct(
        \Magento\Backend\Block\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function render(\Magento\Framework\DataObject $row)
    {
        $pdata = json_decode($this->_getValue($row), true);

        $dropshipping_price = "-";
        if (isset($pdata["dropshipping_price"])) {
            if ($pdata["dropshipping_price"] > 0) {
                $dropshipping_price = round(($pdata["dropshipping_price"] / 1.19), 2);
                $dropshipping_price.= " &euro;";
            }
        }

        return $dropshipping_price;
    }
}
