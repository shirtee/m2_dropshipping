<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Block\Adminhtml\Product;

class Add extends \Magento\Backend\Block\Template
{
    public $shirteeHelper;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->shirteeHelper = $shirteeHelper;
    }
}
