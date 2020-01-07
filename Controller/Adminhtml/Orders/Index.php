<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Orders;

class Index extends \Shirtee\Dropshipping\Controller\Adminhtml\Orders
{
    public function execute()
    {
        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Orders'));
        $this->_view->renderLayout();
    }
}
