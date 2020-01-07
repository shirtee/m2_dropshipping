<?php
/**
 * Copyright © Shirtee. All rights reserved.
 */
namespace Shirtee\Dropshipping\Controller\Adminhtml\Orders;

class Grid extends \Shirtee\Dropshipping\Controller\Adminhtml\Orders
{
    public function execute()
    {
        $this->_view->loadLayout(false);
        $this->_view->renderLayout();
    }
}
