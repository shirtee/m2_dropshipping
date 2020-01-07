<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller;

use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;

abstract class Cloud extends \Magento\Framework\App\Action\Action implements CsrfAwareActionInterface
{
    public $shirteeHelper;
    public $layoutFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper
    ) {
        parent::__construct($context);

        $this->layoutFactory = $layoutFactory;
        $this->shirteeHelper = $shirteeHelper;
    }

    public function createCsrfValidationException(
        RequestInterface $request
    ): ?InvalidRequestException {
        return null;
    }

    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }
}
