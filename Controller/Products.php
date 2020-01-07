<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller;

abstract class Products extends \Magento\Framework\App\Action\Action
{
    public $shirteeHelper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper
    ) {
        parent::__construct($context);

        $this->shirteeHelper = $shirteeHelper;
    }
}
