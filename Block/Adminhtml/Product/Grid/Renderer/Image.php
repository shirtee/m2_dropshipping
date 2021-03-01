<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml\Product\Grid\Renderer;

class Image extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    public function __construct(
        \Magento\Backend\Block\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function render(\Magento\Framework\DataObject $row)
    {
    	$images = json_decode($this->_getValue($row), true);
    	return '<img src="'.str_replace("s=i1100x1200", "s=i135", $images[0]["src"]).'" alt=""/>';
    }
}
