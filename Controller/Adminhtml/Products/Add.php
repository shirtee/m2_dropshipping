<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Products;

class Add extends \Shirtee\Dropshipping\Controller\Adminhtml\Products
{
    public function execute()
    {
        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Add Product'));
        $this->_view->renderLayout();
    }
}
