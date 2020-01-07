<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml;

abstract class Orders extends \Magento\Backend\App\Action
{
    public $fileFactory;
    public $shirteeHelper;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Shirtee\Dropshipping\Helper\Data $shirteeHelper
    ) {
        parent::__construct($context);

        $this->fileFactory = $fileFactory;
        $this->shirteeHelper = $shirteeHelper;
    }

    public function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Shirtee_Dropshipping::orders'
        );
        return $this;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Shirtee_Dropshipping::orders');
    }
}
